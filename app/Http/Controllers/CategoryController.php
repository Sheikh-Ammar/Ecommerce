<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return response()->json([
            'categories' => $categories,
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
    public function store(CategoryRequest $request)
    {
        $validateData = $request->validated();
        $data = array_merge($validateData, ['slug' => Str::slug($validateData['name'])]);
        Category::create($data);
        return response()->json([
            'message' => 'New Category Added',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->get();
            return response()->json([
                'product' => $category,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Slug category not found',
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
    public function update(CategoryRequest $request, $slug)
    {
        $validateData = $request->validated();
        $data = array_merge($validateData, ['slug' => Str::slug($validateData['name'])]);
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->update($data);
            return response()->json([
                'message' => 'Category Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Slug category not found',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->delete();
            return response()->json([
                'message' => 'Category Deleted',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Slug category not found',
            ], 400);
        }
    }
}
