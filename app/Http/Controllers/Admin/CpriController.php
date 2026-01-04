<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CpriSubmission;
use App\Models\BatchRevision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CpriController extends Controller
{
    // show what's ready for cpri and the history
    public function index()
    {
        $ready = BatchRevision::with('batch.productType')
            ->where('status', 'APPROVED')
            ->get();

        $history = CpriSubmission::with('revision.batch.productType')
            ->latest('submission_date')
            ->get();

        return view('admin.cpri.index', compact('ready', 'history'));
    }

    // send it to cpri
    public function store(Request $request)
    {
        $request->validate([
            'batch_revision_id' => 'required|exists:batch_revisions,id',
            'submission_date' => 'required|date',
            'remarks' => 'nullable|string'
        ]);

        $rev = BatchRevision::findOrFail($request->batch_revision_id);

        if ($rev->status != 'APPROVED') {
            return back()->with('error', 'not approved internally yet.');
        }

        try {
            DB::beginTransaction();

            CpriSubmission::create([
                'batch_revision_id' => $request->batch_revision_id,
                'submission_date' => $request->submission_date,
                'remarks' => $request->remarks,
                'status' => 'pending',
                'submitted_by' => Auth::id()
            ]);

            // change status to pending cpri
            $rev->status = 'CPRI_PENDING';
            $rev->save();

            DB::commit();

            return back()->with('success', "batch " . $rev->batch->batch_code . " sent to cpri.");
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', "failed to send batch " . $rev->batch->batch_code . " to cpri.");
        }
    }

    // update the cpri result
    public function update(Request $request, $id)
    {
        $item = CpriSubmission::with('revision.batch')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'cpri_reference' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $item->update([
                'status' => $request->status,
                'cpri_reference' => $request->cpri_reference
            ]);

            // update the main status code
            $new_status = match ($request->status) {
                'approved' => 'CPRI_APPROVED',
                'rejected' => 'CPRI_REJECTED',
                default    => 'CPRI_PENDING'
            };

            $item->revision->update(['status' => $new_status]);

            if ($request->status == 'approved') {
                $item->revision->approved_at = now();
            }

            $item->revision->save();

            DB::commit();

            return back()->with('success', "cpri updated to " . $request->status . " for " . $item->revision->batch->batch_code);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', "failed to update cpri record.");
        }
    }
}
