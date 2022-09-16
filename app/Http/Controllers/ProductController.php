<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->simplePaginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string',
            'price'        => 'required|numeric',
            'quantity'     => 'required|numeric',
            'short_desc'   => 'required|string',
            'photo'        => 'required',
        ]);

        // $product = Product::create($request->except('_token') + ['created_at' => Carbon::now()]);

        if($request->hasFile('photo')){

            foreach ($request->file('photo') as $photo) {

                $new_file_name     = uniqid() . '.' . $photo->extension('photo');
                $upload_location   = public_path('uploads/products');
    
                $photo->move($upload_location, $new_file_name);
                
                Product::insert([
                    'name'         => $request->name,
                    'price'        => $request->price,
                    'quantity'     => $request->quantity,
                    'short_desc'   => $request->short_desc,
                    'long_desc'    => $request->long_desc,
                    'photo'        => $new_file_name,
                    'created_at'   => Carbon::now(),
                ]);
            }

        }

        return redirect()->route('products.index')->with('success', 'product added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $single_product_details = Product::find($product->id);
        return view('admin.products.show', compact('single_product_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $single_product_info = Product::find($product->id);
        return view('admin.products.edit', compact('single_product_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'         => 'required|string',
            'price'        => 'required|numeric',
            'quantity'     => 'required|numeric',
            'short_desc'   => 'required|string',
            'photo'        => 'required',
        ]);

        $product->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        if ($request->hasFile('photo')) {

            $main_photo      = $request->file('photo');
            $new_file_name   = uniqid() . '.' . $main_photo->extension('photo');

            $upload_location = public_path('uploads/products');

            $main_photo->move($upload_location, $new_file_name);

            $product->photo  = $new_file_name;
        }

        $product->save();
        return redirect()->route('products.index')->with('success', 'product Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::find($product->id)->delete();
        return back()->with('success', 'product deleted successfully!');
    }
}
