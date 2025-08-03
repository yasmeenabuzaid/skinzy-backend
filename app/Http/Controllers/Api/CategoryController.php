<?php

// app/Http/Controllers/Api/ProductController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::where('isDelete', false)->get());
    }



public function productsByCategory($categoryId)
{
    $category = Category::with('subCategories.products')
                ->where('id', $categoryId)
                ->where('isDelete', false)
                ->first();

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    $products = $category->subCategories->flatMap(function ($subCategory) {
        return $subCategory->products;
    });

    return response()->json($products);
}

}
