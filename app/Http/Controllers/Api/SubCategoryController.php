<?php

// app/Http/Controllers/Api/ProductController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index()
    {
        return response()->json(SubCategory::all());
    }

    public function getWithSubcategories()
    {
        $categories = Category::select('id', 'name')
            ->with(['subcategories:id,category_id,name'])
            ->get();

        return response()->json($categories);
    }
}
