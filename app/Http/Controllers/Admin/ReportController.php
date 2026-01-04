<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestResult;
use App\Models\Batch;
use App\Models\BatchRevision;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // generate different lab reports
    public function index(Request $request)
    {
        $type = $request->input('report', 'daily_tests');
        $from = $request->input('date_from', now()->subDays(30)->toDateString());
        $to = $request->input('date_to', now()->toDateString());

        $names = [
            'daily_tests' => ['title' => 'daily tests', 'icon' => 'fa-calendar-day'],
            'product_wise' => ['title' => 'product pass/fail', 'icon' => 'fa-microchip'],
            'tester_performance' => ['title' => 'tester stats', 'icon' => 'fa-user-chart'],
            'failure_analysis' => ['title' => 'failure reasons', 'icon' => 'fa-exclamation-triangle']
        ];

        if (!array_key_exists($type, $names)) {
            $type = 'daily_tests';
        }

        $data = [];

        switch ($type) {
            case 'daily_tests':
                $data = TestResult::with(['revision.batch.productType', 'testType', 'tester'])
                    ->whereDate('tested_at', '>=', $from)
                    ->whereDate('tested_at', '<=', $to)
                    ->orderBy('tested_at', 'desc')
                    ->get();
                break;

            case 'product_wise':
                $data = DB::table('test_results')
                    ->join('batch_revisions', 'test_results.batch_revision_id', '=', 'batch_revisions.id')
                    ->join('batches', 'batch_revisions.batch_id', '=', 'batches.id')
                    ->join('product_types', 'batches.product_type_id', '=', 'product_types.id')
                    ->selectRaw("
                        product_types.name as product_type,
                        COUNT(test_results.id) as total_tests,
                        SUM(CASE WHEN test_results.result = 'PASS' THEN 1 ELSE 0 END) as passed,
                        SUM(CASE WHEN test_results.result = 'FAIL' THEN 1 ELSE 0 END) as failed
                    ")
                    ->whereDate('test_results.tested_at', '>=', $from)
                    ->whereDate('test_results.tested_at', '<=', $to)
                    ->groupBy('product_types.name')
                    ->get();
                break;

            case 'tester_performance':
                $data = TestResult::with('tester.dept')
                    ->whereDate('tested_at', '>=', $from)
                    ->whereDate('tested_at', '<=', $to)
                    ->select('tester_id', DB::raw('count(*) as total_tests'), DB::raw('count(distinct batch_revision_id) as unique_revisions'))
                    ->groupBy('tester_id')
                    ->get();
                break;

            case 'failure_analysis':
                $data = TestResult::with('testType')
                    ->where('result', 'FAIL')
                    ->whereDate('tested_at', '>=', $from)
                    ->whereDate('tested_at', '<=', $to)
                    ->select('test_type_id', DB::raw('count(*) as total_failures'), DB::raw('GROUP_CONCAT(DISTINCT remarks SEPARATOR "; ") as common_remarks'))
                    ->groupBy('test_type_id')
                    ->orderBy('total_failures', 'desc')
                    ->get();
                break;
        }

        return view('admin.reports.index', compact('data', 'type', 'names', 'from', 'to'));
    }
}
