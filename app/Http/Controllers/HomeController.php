<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
       //
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 public function index()
{
   $categories = Category::with('subCategories')->get();

   $discountedSubCategories = SubCategory::where('discount', '>', 0)->get();

   if ($discountedSubCategories->count() < 3) {
       $additionalSubCategories = SubCategory::where('discount', '=', 0)
           ->inRandomOrder()
           ->take(3 - $discountedSubCategories->count()) 
           ->get();

       $discountedSubCategories = $discountedSubCategories->concat($additionalSubCategories);
   }

   $products = Product::with('product_images')
       ->where('type', 'main')
       ->where('quantity', '>', 0)
       ->get();

   $discountedProducts = Product::where('discount', '>', 0)
       ->inRandomOrder()
       ->limit(12)
       ->get();

   $latestProduct = Product::latest()->take(9)->get();


    return view('main', [
        'categories' => $categories,
        'products' => $products,
        'latestProduct' => $latestProduct,
        'discountedSubCategories' => $discountedSubCategories,
        'discountedProducts' => $discountedProducts,
    ]);
}

}
