<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    // check where a batch is at
    public function index(Request $req)
    {
        $batch = null;
        if ($req->filled('batch_code')) {
            $batch = Batch::with(['productType.requirements.testType', 'revisions.testResults.testType'])
                ->where('batch_code', $req->batch_code)
                ->first();
        }
        return view('user.status.index', compact('batch'));
    }
}
