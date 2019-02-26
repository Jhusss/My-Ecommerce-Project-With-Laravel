<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        
        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {   
        $request->validate([
            'title' => 'required',
            'url' => 'required'
        ]);

        $input = $request->all();

        if(empty($input['status'])){
            $status = 0;
        } else
            $status = 1;

        $category->title = $input['title'];
        $category->url = $input['url'];
        $category->status = $status;
        $category->save();

        return back()->with('success', 'New Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'title' => 'required',
            'url' => 'required'
        ]);

        $input = $request->all();
        
        if(empty($input['status'])){
            $status = 0;
        } else
            $status = 1;

        $category->title = $input['title'];
        $category->url = $input['url'];
        $category->status = $status;
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
