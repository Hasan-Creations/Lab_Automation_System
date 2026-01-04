<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Models\TestType;
use App\Models\Department;
use App\Models\ProductTestRequirement;
use Illuminate\Http\Request;

class ProductRequirementController extends Controller
{
    // show what products need what tests
    public function index()
    {
        $products = ProductType::with('requirements.testType', 'requirements.department')->get();
        $tests = TestType::all();
        $depts = Department::all();

        return view('admin.requirements.index', compact('products', 'tests', 'depts'));
    }

    // add a new requirement
    public function store(Request $request)
    {
        $request->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'test_type_id' => 'required|exists:test_types,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        // check if we already have it
        $exists = ProductTestRequirement::where('product_type_id', $request->product_type_id)
            ->where('test_type_id', $request->test_type_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'already exists.');
        }

        ProductTestRequirement::create($request->all());

        return back()->with('success', 'added!');
    }

    // remove one
    public function destroy($id)
    {
        ProductTestRequirement::findOrFail($id)->delete();
        return back()->with('success', 'removed.');
    }
}
