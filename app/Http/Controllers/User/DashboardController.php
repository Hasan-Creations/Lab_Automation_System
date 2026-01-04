<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // show the tester their stats and recent work
    public function index()
    {
        $me = Auth::user();

        $info = [
            'today' => TestResult::where('tester_id', $me->id)
                ->whereDate('tested_at', now())
                ->count(),
        ];

        // last 10 tests i did
        $recent = TestResult::with(['revision.batch', 'testType'])
            ->where('tester_id', $me->id)
            ->latest('tested_at')
            ->limit(10)
            ->get();

        return view('user.dashboard', compact('info', 'recent'));
    }
}
