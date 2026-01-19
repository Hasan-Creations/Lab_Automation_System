<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchRevision;
use App\Models\TestResult;
use App\Models\ProductTestRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    // show what batches need testing for my dept
    public function create()
    {
        $me = Auth::user();

        // get batches that are pending and belong to my dept
        $raw = Batch::whereHas('currentRevision', function ($q) {
            $q->where('status', 'PENDING');
        })
            ->whereHas('productType.requirements', function ($q) use ($me) {
                $q->where('department_id', $me->department_id);
            })
            ->with(['productType.requirements' => function ($q) use ($me) {
                $q->where('department_id', $me->department_id);
            }, 'currentRevision.testResults'])
            ->get();

        // filter out the ones that are already done
        $pending = $raw->filter(function ($batch) use ($me) {
            $rev = $batch->currentRevision;
            $needed = $batch->productType->requirements->pluck('test_type_id')->toArray();
            $done = $rev->testResults->pluck('test_type_id')->toArray();

            if (empty($needed)) {
                return false;
            }

            // simple check if any test is missing
            $missing = false;
            foreach ($needed as $id) {
                if (!in_array($id, $done)) {
                    $missing = true;
                    break;
                }
            }

            return $missing;
        });

        return view('user.tests.create', compact('pending'));
    }

    // save a test result
    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'test_type_id' => 'required|exists:test_types,id',
            'result' => 'required|in:PASS,FAIL',
            'observed_value' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $batch = Batch::with(['productType.requirements', 'currentRevision'])->findOrFail($request->batch_id);
        $rev = $batch->currentRevision;

        if ($rev->status != 'PENDING') {
            return back()->with('error', 'this one is already closed.');
        }

        // is the user allowed to do this?
        $ok = ProductTestRequirement::where('product_type_id', $batch->product_type_id)
            ->where('test_type_id', $request->test_type_id)
            ->where('department_id', Auth::user()->department_id)
            ->exists();

        if (!$ok) {
            return back()->with('error', 'not authorized for this test.');
        }

        try {
            DB::beginTransaction();

            // log the result
            TestResult::create([
                'batch_revision_id' => $rev->id,
                'test_type_id' => $request->test_type_id,
                'tester_id' => Auth::id(),
                'result' => $request->result,
                'observed_value' => $request->observed_value,
                'remarks' => $request->remarks,
                'tested_at' => now(),
            ]);

            $msg = "logged.";

            if ($request->result == 'FAIL') {
                // if it fails, the whole thing fails
                $rev->status = 'FAILED';
                $rev->failed_at = now();
                $rev->save();
                $msg = "batch " . $batch->batch_code . " failed!";
            } else {
                // checking if everything is passed now
                $all_needed = $batch->productType->requirements->pluck('test_type_id')->toArray();
                $all_passed = TestResult::where('batch_revision_id', $rev->id)
                    ->where('result', 'PASS')
                    ->pluck('test_type_id')
                    ->toArray();

                // manual comparison check
                $everything_done = true;
                foreach ($all_needed as $id) {
                    if (!in_array($id, $all_passed)) {
                        $everything_done = false;
                        break;
                    }
                }

                if ($everything_done == true) {
                    $rev->status = 'APPROVED';
                    $rev->approved_at = now();
                    $rev->save();
                    $msg = "batch " . $batch->batch_code . " is fully approved!";
                }
            }

            DB::commit();

            return redirect()->route('user.dashboard')->with('success', $msg);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', "critical: failed to log test. error: " . $e->getMessage());
        }
    }
}
