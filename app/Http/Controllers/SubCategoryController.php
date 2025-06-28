<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
         $Subcategories = SubCategory::all(); 
      
        return view('dashboard.Subcategories.index' , ['Subcategories'=> $Subcategories]);
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= category::all();
        return view ('dashboard.Subcategories.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/subcategory/');
            $file->move($path, $filename);
        }

        $subCategory = SubCategory::create([
            'name'=>$request->input('name'),
            'image'=>$filename,
            'category_id'=> $request->input('category_id'),
        ]);

       

       

        return to_route('subCategories.index')->with('success', 'Sub category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories= category::all();
        return view('dashboard.Subcategories.edit' , ['subCategory'=> $subCategory ,  'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'discount' => 'nullable|numeric|min:0|max:100',
            'category_id' => 'required|exists:categories,id',

        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/subcategory/');
            $file->move($path, $filename);
        } else {
            $filename = $subCategory->image; 
        }

        $subCategory->update([
            'name'=>$request->input('name'),
            'image'=>$filename,
            'discount' => $request->input('discount'), 
            'category_id'=> $request->input('category_id'),
        ]);

        Product::where('subCategory_id', $subCategory->id)->update([
            'discount' => $request->input('discount'),
        ]);
       

        return to_route('subCategories.index')->with('success', 'Sub category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {

         // Check if the subcategory has products with order details (i.e., related to orders)
         $hasOrders = $subCategory->products()->whereHas('orderDetails')->exists();

         if ($hasOrders) {
            return redirect()->back()->with('error', 'Cannot delete subcategory as it has products in orders.');
        }

        $subCategory->delete(); 
        
        return to_route('subCategories.index')->with('success', 'Sub category deleted');
    }

}
