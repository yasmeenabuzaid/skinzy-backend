<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.brands.index', ['brands' => $brands]);
    }

    public function softDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->isDelete = true;
        $brand->save();

        // Update related products
        $brand->products()->update(['isDelete' => true]);

        return redirect()->back()->with('success', 'Brand and related products marked as deleted.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.create');
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

    $imageUrl = null;
    if ($request->hasFile('image')) {
        $file = $request->file('image');

        $uploadResult = Cloudinary::upload($file->getRealPath());

        $imageUrl = $uploadResult->getSecurePath();
    }

    Brand::create([
        'name' => $request->input('name'),
        'image' => $imageUrl,
    ]);

    return to_route('brands.index')->with('success', 'Brand created successfully');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/brand/');
            $file->move($path, $filename);
        } else {
            $filename = $brand->image;
        }

        $brand->update([
            'name' => $request->input('name'),
            'image' => $filename,
        ]);

        return to_route('brands.index')->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {


        $brand->delete();

        return to_route('brands.index')->with('success', 'Brand deleted');
    }
}
