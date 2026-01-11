<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    // list all product types
    public function index()
    {
        $list = ProductType::all();
        return view('admin.product_types.index', compact('list'));
    }

    // save a new product type
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_types,name',
            'prefix' => 'required|max:3|unique:product_types,prefix',
            'description' => 'nullable|string'
        ]);

        ProductType::create($request->all());

        return back()->with('success', 'New product type added successfully!');
    }

    // update product type
    public function update(Request $request, $id)
    {
        $type = ProductType::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:product_types,name,' . $type->id,
            'prefix' => 'required|max:3|unique:product_types,prefix,' . $type->id,
            'description' => 'nullable|string'
        ]);

        $type->update($request->all());

        return back()->with('success', 'Product type updated!');
    }

    // delete
    public function destroy($id)
    {
        $type = ProductType::findOrFail($id);

        // check if it has batches
        if ($type->batches()->exists()) {
            return back()->with('error', 'Cannot delete this type because it has active batches.');
        }

        $type->delete();

        return back()->with('success', 'Product type removed.');
    }
}
