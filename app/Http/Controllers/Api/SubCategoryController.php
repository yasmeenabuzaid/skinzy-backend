<?php


// -------------------------------------------------------------------

// app/Http/Controllers/Api/SubCategoryController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Cache; // <-- ١. إضافة Cache

class SubCategoryController extends Controller
{
    public function index()
    {
        // ٢. تغليف المنطق الأصلي داخل Cache::remember
        $subcategories = Cache::remember('subcategories_index', 3600 * 24, function () { // تخزين لمدة يوم
            // -- المنطق الأصلي الخاص بك كما هو --
            return SubCategory::where('isDelete', false)->get();
            // -- نهاية المنطق الأصلي --
        });

        return response()->json($subcategories);
    }

    public function getWithSubcategories()
    {
        $categories = Cache::remember('categories_with_subcategories', 3600, function () {
            // -- المنطق الأصلي الخاص بك كما هو --
            return Category::select('id', 'name', 'name_ar')
                ->where('isDelete', false)
                ->with(['subcategories' => function ($query) {
                    $query->select('id', 'category_id', 'name', 'name_ar')
                          ->where('isDelete', false);
                }])
                ->get();
            // -- نهاية المنطق الأصلي --
        });

        return response()->json($categories);
    }
}
