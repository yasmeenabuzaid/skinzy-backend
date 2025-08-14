<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;

class BulkEntryController extends Controller
{
    public function index()
    {
        // Fetch all data needed for all tabs
        $categories = Category::where('isDelete', false)->get();
        $subCategories = SubCategory::where('isDelete', false)->get();
        $brands = Brand::all();

        return view('dashboard.bulk-entry.index', [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'brands' => $brands,
        ]);
    }
}
