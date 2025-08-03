<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('isDelete', false)->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function softDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->isDelete = true;
        $category->save();

        $category->subcategories()->update(['isDelete' => true]);

        return redirect()->back()->with('success', 'Category and related products marked as deleted.');
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'name_ar'  => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadResult = Cloudinary::upload($file->getRealPath());
            $imageUrl = $uploadResult->getSecurePath();
        }

        Category::create([
            'name'  => $request->input('name'),
            'name_ar'  => $request->input('name_ar'),
            'image' => $imageUrl,
        ]);

        return to_route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string',
            'name_ar'  => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageUrl = $category->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadResult = Cloudinary::upload($file->getRealPath());
            $imageUrl = $uploadResult->getSecurePath();
        }

        $category->update([
            'name_ar'  => $request->input('name_ar'),
            'name'  => $request->input('name'),
            'image' => $imageUrl,
        ]);

        return to_route('categories.index')->with('success', 'Category updated successfully');
    }

public function destroy(Category $category)
{
    $category->isDelete = true;
    $category->save();

    $category->subCategories()->update(['isDelete' => true]);

    return to_route('categories.index')->with('success', 'Category marked as deleted along with its subcategories.');
}

}
