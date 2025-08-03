<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index()
    {
        return response()->json(SubCategory::where('isDelete', false)->get());
    }

    public function getWithSubcategories()
    {
        $categories = Category::select('id', 'name','name_ar')
            ->where('isDelete', false)
            ->with(['subcategories' => function ($query) {
                $query->select('id', 'category_id', 'name','name_ar')
                      ->where('isDelete', false);
            }])
            ->get();

        return response()->json($categories);
    }
}
