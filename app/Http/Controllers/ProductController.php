<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // index
    public function index()
    {
        return view('pages.products.index');
    }

    // create
    public function create()
    {
        return view('pages.products.create');
    }

    // store
    public function store(Request $request)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // store the request...
        //$product = new Product;
        //$product->name = $request->name;
        //$product->description = $request->description;
        //$product->price = $request->price;
        //$product->category_id = $request->category_id;
        //$product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // show
    public function show($id)
    {
        return view('pages.products.show');
    }

    // edit
    public function edit($id)
    {
        return view('pages.products.edit');
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // update the request...
        // $product = Product::find($id);
        // $product->name = $request->name;
        // $product->desciption = $request->description;
        // $product->price = $request->price;
        // $product->category_id = $request->category_id;
        // $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        // delete the request...
        // $product = Product::find($id);
        // $product->delete();
    }
}
