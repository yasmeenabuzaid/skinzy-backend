<?php
namespace App\Http\Controllers;
use App\Scopes\NotDeletedScope;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;


class DeletedItemsController extends Controller
{
    public function deletedCategories()
    {
        $categories = Category::withoutGlobalScope(NotDeletedScope::class)
                              ->where('isDelete', 1)

                              ->get();

        return view('dashboard.deleted.categories', compact('categories'));
    }

    public function deletedSubCategories()
    {
        $subCategories = SubCategory::withoutGlobalScope(NotDeletedScope::class)
                                    ->where('isDelete', 1)

                                    ->get();

        return view('dashboard.deleted.subCategories', compact('subCategories'));
    }

    public function deletedProducts()
    {
        $products = Product::withoutGlobalScope(NotDeletedScope::class)
                           ->where('isDelete', 1)
                           ->with('images')
                           ->get();

        return view('dashboard.deleted.products', compact('products'));
    }

    public function restoreCategory($id)
    {
        $category = Category::withoutGlobalScope(NotDeletedScope::class)->findOrFail($id);
        $category->isDelete = 0;
        $category->save();

        return redirect()->route('deleted.categories')->with('success', 'Category restored successfully.');
    }

    public function restoreSubCategory($id)
    {
        $subCategory = SubCategory::withoutGlobalScope(NotDeletedScope::class)->findOrFail($id);
        $subCategory->isDelete = 0;
        $subCategory->save();

        return redirect()->route('deleted.subCategories')->with('success', 'Sub Category restored successfully.');
    }

    public function restoreProduct($id)
    {
        $product = Product::withoutGlobalScope(NotDeletedScope::class)->findOrFail($id);
        $product->isDelete = 0;
        $product->save();

        return redirect()->route('deleted.products')->with('success', 'Product restored successfully.');
    }

    public function forceDeleteCategory($id)
    {
        $category = Category::withoutGlobalScope(NotDeletedScope::class)->findOrFail($id);
        $category->delete();

        return redirect()->route('deleted.categories')->with('success', 'Category permanently deleted.');
    }

    public function forceDeleteSubCategory($id)
    {
        $subCategory = SubCategory::withoutGlobalScope(NotDeletedScope::class)->findOrFail($id);
        $subCategory->delete();

        return redirect()->route('deleted.subCategories')->with('success', 'Sub Category permanently deleted.');
    }

    public function forceDeleteProduct($id)
    {
        $product = Product::withoutGlobalScope(NotDeletedScope::class)->findOrFail($id);
        $product->delete();

        return redirect()->route('deleted.products')->with('success', 'Product permanently deleted.');
    }
}
