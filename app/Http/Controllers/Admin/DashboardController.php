<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\TestResult;
use App\Models\BatchRevision;
use App\Models\CpriSubmission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // show what's happening in the lab
    public function index()
    {
        // just some basic numbers
        $info = [
            'active_batches' => Batch::count(),
            'pending_review' => BatchRevision::where('status', 'PENDING')->count(),
            'failed_cycles'  => BatchRevision::where('status', 'FAILED')->count(),
            'external_queue' => CpriSubmission::where('status', 'pending')->count(),
        ];

        // the last 8 tests done
        $recent = TestResult::with(['revision.batch', 'testType', 'tester'])
            ->latest('tested_at')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('info', 'recent'));
    }
}
