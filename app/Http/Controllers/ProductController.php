<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category:id,name')->paginate(10);
        //$cat = Category::with('product')->paginate(10);
        return response()->json([
            'products' => $products,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile("image")) {
            $image = $request->file('image');
            $destinationPath = 'images/products/';
            $imgNewName = time() . "-" . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgNewName);
            $data['image'] = $imgNewName;
        }
        Product::create($data);
        return response()->json([
            'message' => 'Product Added',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->get();
            return response()->json([
                'product' => $product,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id product not found',
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile("image")) {
            $destinationPath = 'images/products/' . $data['image'];
            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
            $image = $request->file('image');
            $destinationPath = 'images/product/';
            $imgNewName = time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgNewName);
            $data['image'] = $imgNewName;
        }
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            return response()->json([
                'message' => 'Product Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id product not found',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorFail($id);
        $destination = 'images/products/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product Deleted',
        ], 200);
    }
}
