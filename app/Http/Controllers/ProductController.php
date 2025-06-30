<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Feedback;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


// public function getVariation($id)
// {
//     $variation = Product::with('product_images')->findOrFail($id);
//     return response()->json([
//         'id' => $variation->id,
//         'name' => $variation->name,
//         'price' => $variation->price,
//         'small_description' => $variation->small_description,
//         'image' => asset($variation->product_images->first()->image ?? 'default-image.jpg'),
//     ]);
// }

    public function index(Request $request)
    {

       $products = Product::with('product_images')->get();
$mainProducts = Product::where('type', 'main')->with('variations', 'product_images')->get();

       return view('dashboard.products.index' , ['products'=> $products , 'mainProducts'=>$mainProducts]);
    }

    public function shop(Request $request)
{
    $categories = Category::all();

    $products = Product::with('product_images')
        ->where('quantity', '>', 0)
        ->get();

    return view('shop', [
        'products' => $products,
        'categories' => $categories
    ]);
}


    public function dark(Request $request)
    {
        $products = Product::with(['product_images', 'subCategory.category'])
            ->where('quantity', '>', 0)
            ->whereHas('subCategory', function ($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%dark%'])
                    ->orWhereHas('category', function ($q) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%dark%']);
                    });
            })
            ->get();

        $categories = Category::whereRaw('LOWER(name) LIKE ?', ['%dark%'])->get();

        return view('chocolaterie-dark', [
            'products' => $products,
            'categories' => $categories
        ]);
    }




    public function light(Request $request)
    {
        $products = Product::with(['product_images', 'subCategory.category'])
            ->where('quantity', '>', 0)
            ->whereHas('subCategory', function ($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%white%'])
                    ->orWhereRaw('LOWER(name) LIKE ?', ['%milk%'])
                    ->orWhereRaw('LOWER(name) LIKE ?', ['%حليب%'])
                    ->orWhereHas('category', function ($q) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%white%'])
                            ->orWhereRaw('LOWER(name) LIKE ?', ['%milk%'])
                            ->orWhereRaw('LOWER(name) LIKE ?', ['%حليب%']);
                    });
            })
            ->get();

        $categories = Category::where(function ($q) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%white%'])
                ->orWhereRaw('LOWER(name) LIKE ?', ['%milk%'])
                ->orWhereRaw('LOWER(name) LIKE ?', ['%حليب%']);
        })->get();

        return view('chocolaterie-light', [
            'products' => $products,
            'categories' => $categories
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainProducts = Product::where('type', 'main')->get();

        $Categories= Category::all();

        return view ('dashboard.products.create',['Categories'=>$Categories ,'mainProducts'=>$mainProducts]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validation = $request->validate([
        'name' => 'required|string',
        'small_description' => 'required|string',
        'description' => 'required',
        'price_after_discount' => 'nullable|numeric',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        'category_id' => 'required|exists:categories,id',
        'type' => 'required|in:main,variation',
        'parent_product_id' => 'nullable|exists:products,id',

        // Product details fields
        'brand' => 'nullable|string',
        'shade' => 'nullable|string',
        'finish' => 'nullable|in:matte,glossy,satin,shimmer',
        'skin_type' => 'nullable|in:oily,dry,combination,sensitive',
        'ingredients' => 'nullable|string',
        'volume' => 'nullable|string',
        'usage_instructions' => 'nullable|string',
    ]);

    // Create the product
    $product = Product::create([
        'name' => $request->name,
        'small_description' => $request->small_description,
        'description' => $request->description,
        'price' => $request->price,
        'price_after_discount' => $request->price_after_discount,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
        'type' => $request->type,
        'parent_product_id' => $request->type === 'variation' ? $request->parent_product_id : null,
    ]);

    // Save images
    if ($request->hasFile('image')) {
        $images = [];
        foreach ($request->file('image') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/productImages/'), $filename);

            $images[] = [
                'image' => 'uploads/productImages/' . $filename,
                'product_id' => $product->id,
            ];
        }
        ProductImage::insert($images);
    }

    // Create product_details
    ProductDetail::create([
        'product_id' => $product->id,
        'brand' => $request->brand,
        'shade' => $request->shade,
        'finish' => $request->finish,
        'skin_type' => $request->skin_type,
        'ingredients' => $request->ingredients,
        'volume' => $request->volume,
        'usage_instructions' => $request->usage_instructions,
    ]);

    return to_route('products.index')->with('success', 'Product created successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productImages = $product->product_images;

        $product_details = ProductDetail::where('product_id', $product->id)->first();

        return view('dashboard.products.show', [
            'product' => $product,
            'productImages' => $productImages,
            'product_details' => $product_details,
        ]);
    }





  public function show_user_side($id)
{
    // $product = Product::findOrFail($id);

$product = Product::with('product_images')->find($id);

if ($product->type == 'main') {
    // المنتج هو Main => جلب الفاريشنز المرتبطة فقط
    $variations = Product::where('parent_product_id', $product->id)->with('product_images')->get();
    $mainProduct = $product; // المنتج نفسه
} else {
    // المنتج هو Variation => جلب المنتج الرئيسي + كل الفاريشنز المرتبطة به
    $mainProduct = Product::where('id', $product->parent_product_id)->with('product_images')->first();
    $variations = Product::where('parent_product_id', $mainProduct->id)->with('product_images')->get();
}


    $feedbacks = Feedback::where('product_id', $product->id)->get();

    $totalFeedbacks = $feedbacks->count();
    $averageRating = $feedbacks->avg('rating');

    $product_details = ProductDetail::where('product_id', $product->id)->first();

    $allproducts = Product::with('product_images')
        ->whereHas('feedbacks', function ($query) {
            $query->havingRaw('AVG(rating) >= 3');
        })
        ->get();

    if ($allproducts->isEmpty()) {
        $allproducts = Product::with('product_images')->get();
    }

    $productImages = $product->product_images;

    $relatedProducts = Product::where('subCategory_id', $product->subCategory_id)
        ->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->take(12)
        ->get();

    return view('single', [
        'product' => $product,
        'productImages' => $productImages,
        'relatedProducts' => $relatedProducts,
        'allproducts' => $allproducts,
        'feedbacks' => $feedbacks,
        'totalFeedbacks' => $totalFeedbacks,
        'averageRating' => $averageRating,
        'product_details' => $product_details,
        'variations' => $variations,
        'mainProduct'=>$mainProduct
    ]);
}







    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product_details = ProductDetail::where('product_id', $product->id)->first();
        $SubCategories= SubCategory::all();
        $productImages = $product->product_images;
        return view ('dashboard.products.edit',[
            'product'=>$product ,
            'SubCategories'=>$SubCategories,
            'productImages'=>$productImages,
            'product_details'=>$product_details
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required',
            'old_price' => 'nullable|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
            'subCategory_id' => 'required|exists:sub_categories,id',
            'weight' => 'nullable|numeric',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
            'origin_country' => 'nullable|string',
            'is_organic' => 'nullable|boolean',
            'is_sugar_free' => 'nullable|boolean',
            'is_gluten_free' => 'nullable|boolean',
        ]);



        $product->update([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'old_price'=>$request->input('old_price'),
            'price'=>$request->input('price'),
            'quantity'=>$request->input('quantity'),
            'subCategory_id'=>$request->input('subCategory_id'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {

                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/productImages/');
                $file->move($path, $filename);


                $images[] = [
                    'image' => 'uploads/productImages/' . $filename,
                    'product_id'=> $product->id,
                ];
            }


            ProductImage::insert($images);
        }

        ProductDetail::updateOrCreate(
            ['product_id' => $product->id],
            [
                'weight' => $request->input('weight'),
                'ingredients' => $request->input('ingredients'),
                'allergens' => $request->input('allergens'),
                'origin_country' => $request->input('origin_country'),
                'is_organic' => $request->has('is_organic'),
                'is_sugar_free' => $request->has('is_sugar_free'),
                'is_gluten_free' => $request->has('is_gluten_free'),
            ]
        );


        return to_route('products.index')->with('success', 'Product updated successfully');
    }


    public function productsByCategory($id, Request $request)
    {
        $allcategories = Category::all();

        $category = Category::findOrFail($id);

        $maxPrice = Product::whereHas('subCategory', function ($query) use ($id) {
            $query->where('category_id', $id);
        })
        ->where('quantity', '>', 0)
        ->max('price');

        $query = Product::with('product_images')
            ->where('quantity', '>', 0)
            ->whereHas('subCategory', function ($query) use ($id) {
                $query->where('category_id', $id);
            });

        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = $request->query('min_price', 0);
            $maxPrice = $request->query('max_price', $maxPrice);

            $query->where(function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice])
                      ->orWhere(function ($query) use ($minPrice, $maxPrice) {
                          $query->whereRaw('price - (price * discount / 100) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                      });
            });
        }

        $products = $query->orderBy('name', 'asc')->paginate(16);

        $displayedCategories = $allcategories->where('id', '!=', $id);

        return view('products-by-category', compact(
            'products',
            'category',
            'maxPrice',
            'allcategories',
            'displayedCategories'
        ));
    }





    public function productsBySubCategory($id, Request $request)
    {

        $subCategory = SubCategory::findOrFail($id);


        $maxPrice = Product::where('subCategory_id', $id)->max('price');


        $query = Product::with('product_images')->where('subCategory_id', $id);

        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = $request->query('min_price', 0);
            $maxPrice = $request->query('max_price', $maxPrice);

            $query->where(function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice])
                      ->orWhere(function ($query) use ($minPrice, $maxPrice) {
                          $query->whereRaw('price - (price * discount / 100) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                      });
            });
        }


        $products = $query->orderBy('name', 'asc')->paginate(16);

        return view('store', compact('products', 'subCategory', 'maxPrice'));
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->orderDetails()->exists()) {
            return to_route('products.index')->with('error', 'Cannot delete a product with active orders.');
        }

        $product->delete();

        return to_route('products.index')->with('success', 'Product deleted');
    }
}
