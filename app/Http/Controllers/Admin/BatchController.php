<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchRevision;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    // list out all the batches
    public function index()
    {
        // get all batches with early loading
        $list = Batch::with(['productType', 'currentRevision'])
            ->latest()
            ->paginate(15);

        $types = ProductType::all();

        return view('admin.batches.index', compact('list', 'types'));
    }

    // save a new batch and start R01
    public function store(Request $request)
    {
        // basic manual validation check
        $request->validate([
            'product_id' => 'required|string|size:10|unique:batches,product_id',
            'batch_code' => 'required|unique:batches',
            'product_type_id' => 'required|exists:product_types,id',
            'quantity' => 'required|integer|min:1',
            'manufacturing_number' => 'nullable|string',
        ]);

        // Create new batch manually (not using create($data))
        $batch = new Batch();
        $batch->product_id = $request->product_id;
        $batch->batch_code = $request->batch_code;
        $batch->product_type_id = $request->product_type_id;
        $batch->quantity = $request->quantity;
        $batch->manufacturing_number = $request->manufacturing_number;
        $batch->save();

        // start the first revision manually
        $rev = new BatchRevision();
        $rev->batch_id = $batch->id;
        $rev->revision_number = 'R01';
        $rev->status = 'PENDING';
        $rev->created_by = Auth::id();
        $rev->save();

        return redirect()
            ->route('admin.batches.index')
            ->with('success', "batch " . $batch->batch_code . " created!");
    }

    // see details of one batch
    public function show($id)
    {
        $item = Batch::with([
            'productType',
            'revisions.testResults.testType',
            'revisions.testResults.tester',
            'revisions.creator'
        ])->findOrFail($id);

        return view('admin.batches.show', compact('item'));
    }

    // if it fails, we make a new revision
    public function remake($id)
    {
        $batch = Batch::with('currentRevision')->findOrFail($id);
        $last = $batch->currentRevision;

        // basic status check
        if ($last->status != 'FAILED') {
            if ($last->status != 'CPRI_REJECTED') {
                return back()->with('error', 'can only remake if it failed.');
            }
        }

        // more basic way to generate next code (R01 -> R02)
        $num_str = filter_var($last->revision_number, FILTER_SANITIZE_NUMBER_INT);
        $num = (int) $num_str;
        $next_num = $num + 1;

        // simple padding logic
        if ($next_num < 10) {
            $next = 'R0' . $next_num;
        } else {
            $next = 'R' . $next_num;
        }

        $rev = new BatchRevision();
        $rev->batch_id = $batch->id;
        $rev->revision_number = $next;
        $rev->status = 'PENDING';
        $rev->created_by = Auth::id();
        $rev->save();

        return redirect()
            ->route('admin.batches.index')
            ->with('success', "started " . $next . " for " . $batch->batch_code);
    }

    // delete a batch
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return back()->with('success', "removed " . $batch->batch_code);
    }
}
