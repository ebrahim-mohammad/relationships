<?php

namespace App\Http\Controllers;

use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index()
    {
        // Get all product lists
        $productLists = ProductList::all();
        return response()->json($productLists);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new product list
        $productList = ProductList::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return response()->json($productList, 201);
    }

    public function show($id)
    {
        // Find the product list by id
        $productList = ProductList::findOrFail($id);
        return response()->json($productList);
    }

    public function update(Request $request, $id)
    {
        // Find the product list by id
        $productList = ProductList::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Update the product list
        $productList->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return response()->json($productList, 200);
    }

    public function destroy($id)
    {
        // Find the product list by id and delete it
        $productList = ProductList::findOrFail($id);
        $productList->delete();
        return response()->json(null, 204);
    }
}
