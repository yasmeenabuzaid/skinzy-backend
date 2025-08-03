<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class DeletedItemsController extends Controller
{
    public function deletedCategories()
    {
        $categories = Category::where('isDelete', 1)->get();
        return view('dashboard.deleted.categories', compact('categories'));
    }

    public function deletedSubCategories()
    {
        $subCategories = SubCategory::where('isDelete', 1)->get();
        return view('dashboard.deleted.subCategories', compact('subCategories'));
    }

    public function deletedProducts()
    {
        $products = Product::where('isDelete', 1)->get();
        return view('dashboard.deleted.products', compact('products'));
    }

    // استرجاع كاتيجوري
    public function restoreCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->isDelete = 0;
        $category->save();

        return redirect()->route('deleted.categories')->with('success', 'Category restored successfully.');
    }

    // استرجاع سب كاتيجوري
    public function restoreSubCategory($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->isDelete = 0;
        $subCategory->save();

        return redirect()->route('deleted.subCategories')->with('success', 'Sub Category restored successfully.');
    }

    // استرجاع برودكت
    public function restoreProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->isDelete = 0;
        $product->save();

        return redirect()->route('deleted.products')->with('success', 'Product restored successfully.');
    }

    // حذف نهائي كاتيجوري
    public function forceDeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // حذف نهائي من القاعدة

        return redirect()->route('deleted.categories')->with('success', 'Category permanently deleted.');
    }

    // حذف نهائي سب كاتيجوري
    public function forceDeleteSubCategory($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->route('deleted.subCategories')->with('success', 'Sub Category permanently deleted.');
    }

    // حذف نهائي برودكت
    public function forceDeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('deleted.products')->with('success', 'Product permanently deleted.');
    }
}
