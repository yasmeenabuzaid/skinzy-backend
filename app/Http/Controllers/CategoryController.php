<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $categories = Category::all();

        return view('dashboard.categories.index' , ['categories'=> $categories]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/category/');
            $file->move($path, $filename);
        }

        Category::create([
            'name'=>$request->input('name'),
            'image'=>$filename,
        ]);



        return to_route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Category $category)
    // {
    //     $categories = Category::all();

    //     return view('components.user_side.shop.categories' , ['categories'=> $categories]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit' , ['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/category/');
            $file->move($path, $filename);
        } else {
            $filename = $category->image;
        }

        $category->update([
            'name'=>$request->input('name'),
            'image'=>$filename,
        ]);



        return to_route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $hasOrders = $category->subCategories()
        ->whereHas('products', function ($query) {
            // Check if the product has any related orderDetails
            $query->whereHas('orderDetails');
        })
        ->exists();

        if ($hasOrders) {
           return redirect()->back()->with('error', 'Cannot delete category as it has subcategories with products in orders.');
        }


        $category->delete();

        return to_route('categories.index')->with('success', 'Category deleted');
    }
}
