<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestType;
use App\Models\Department;
use Illuminate\Http\Request;

class TestTypeController extends Controller
{
    // list out all the tests we can do
    public function index()
    {
        $list = TestType::orderBy('test_name', 'asc')->get();
        $depts = Department::all();
        return view('admin.test_types.index', compact('list', 'depts'));
    }

    // save a new test kind
    public function store(Request $request)
    {
        $request->validate([
            'test_code' => 'required|string|max:50|unique:test_types,test_code',
            'test_name' => 'required|string|max:100',
            'department' => 'required|string',
            'description' => 'nullable|string',
            'criteria' => 'nullable|string',
        ]);

        TestType::create($request->all());

        return redirect()->route('admin.test-types.index')->with('success', "added " . $request->test_name . "!");
    }
}
