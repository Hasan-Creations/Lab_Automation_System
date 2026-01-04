<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TestResult;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // search for tests by batch code, tester name, or id
    public function index(Request $request)
    {
        $all = TestResult::query()->with(['revision.batch', 'testType', 'tester']);

        if ($request->filled('search')) {
            $q = $request->search;
            $all->where(function ($query) use ($q) {
                $query->whereHas('revision.batch', function ($bq) use ($q) {
                    $bq->where('batch_code', 'like', "%$q%");
                })
                    ->orWhere('test_id', 'like', "%$q%")
                    ->orWhereHas('tester', function ($uq) use ($q) {
                        $uq->where('full_name', 'like', "%$q%");
                    })
                    ->orWhereHas('testType', function ($tq) use ($q) {
                        $tq->where('test_name', 'like', "%$q%");
                    });
            });
        }

        if ($request->filled('date_from')) {
            $all->whereDate('tested_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $all->whereDate('tested_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $all->where('result', $request->status);
        }

        $list = $all->orderBy('tested_at', 'desc')->paginate(15);

        return view('user.search.index', compact('list'));
    }
}
