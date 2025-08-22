<?php

// -------------------------------------------------------------------

// app/Http/Controllers/Api/CategoryController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Cache; // <-- ١. إضافة Cache

class CategoryController extends Controller
{
    public function index()
    {
        // ٢. تغليف المنطق الأصلي داخل Cache::remember
        $categories = Cache::remember('categories_index', 3600 * 24, function () { // تخزين لمدة يوم
            // -- المنطق الأصلي الخاص بك كما هو --
            return Category::where('isDelete', false)->get();
            // -- نهاية المنطق الأصلي --
        });

        return response()->json($categories);
    }

    public function productsByCategory($categoryId)
    {
        $products = Cache::remember("category_products_{$categoryId}", 3600, function () use ($categoryId) {
            // -- المنطق الأصلي الخاص بك كما هو --
            $category = Category::with('subCategories.products.images')
                ->where('id', $categoryId)
                ->where('isDelete', false)
                ->first();

            if (!$category) {
                // نرجع null ليتم التعامل معه خارج الـ Cache
                return null;
            }

            return $category->subCategories->flatMap(function ($subCategory) {
                return $subCategory->products;
            });
            // -- نهاية المنطق الأصلي --
        });

        if (is_null($products)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($products);
    }
}
