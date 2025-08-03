<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
  use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $Subcategories = SubCategory::where('isDelete', false)
        ->whereHas('category', function ($query) {
            $query->where('isDelete', false);
        })
        ->get();

    return view('dashboard.Subcategories.index', ['Subcategories' => $Subcategories]);
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= category::where('isDelete', false)->get();
        return view ('dashboard.Subcategories.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $validation = $request->validate([
        'name' => 'required|string',
        'name_ar' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);


    $subCategory = SubCategory::create([
        'name' => $request->input('name'),
        'name_ar' => $request->input('name_ar'),
        'category_id' => $request->input('category_id'),
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
        $categories= category::where('isDelete', false)->get();
        return view('dashboard.Subcategories.edit' , ['subCategory'=> $subCategory ,  'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, SubCategory $subCategory)
{
    $validation = $request->validate([
        'name' => 'required|string',
        'name_ar' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);

    // If image is uploaded, upload it to Cloudinary
    if ($request->hasFile('image')) {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $subCategory->image = $uploadedFileUrl;
    }

    $subCategory->update([
        'name' => $request->input('name'),
        'name_ar' => $request->input('name_ar'),
        'category_id' => $request->input('category_id'),
    ]);

    return to_route('subCategories.index')->with('success', 'Sub category updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(SubCategory $subCategory)
{
    $hasOrders = $subCategory->products()->whereHas('orderDetails')->exists();

    if ($hasOrders) {
        return redirect()->back()->with('error', 'Cannot delete subcategory as it has products in orders.');
    }

    $subCategory->isDelete = true;
    $subCategory->save();

    return to_route('subCategories.index')->with('success', 'Sub category deleted');
}

}
