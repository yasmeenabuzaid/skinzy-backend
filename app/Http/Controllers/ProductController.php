<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\Feedback;
use App\Models\Specification;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */



public function index(Request $request)
{
    $products = Product::with(['images', 'subCategory'])
        ->where('isDelete', false)
        ->get();

    $mainProducts = Product::where('type', 'main')
        ->where('isDelete', false)
        ->with(['variations', 'images', 'subCategory'])
        ->get();

    return view('dashboard.products.index', [
        'products'     => $products,
        'mainProducts' => $mainProducts,
    ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainProducts = Product::where('type', 'main')->get();
 $brands = Brand::all();
        $SubCategories= SubCategory::where('isDelete', false)->get();

        return view ('dashboard.products.create',['SubCategories'=>$SubCategories ,'mainProducts'=>$mainProducts,'brands'=>$brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validation = $request->validate([
        'name' => 'required|string',
        'name_ar' => 'required|string',
        'small_description' => 'required|string',
        'small_description_ar' => 'required|string',
        'description' => 'required',
        'description_ar' => 'required',
        'price_after_discount' => 'nullable|numeric',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        'sub_category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'type' => 'required|in:main,variation',
        'parent_product_id' => 'nullable|exists:products,id',



        'specifications' => 'nullable|array',
        'specifications.*.key' => 'nullable|string',
        'specifications.*.key_ar' => 'nullable|string',
        'specifications.*.value' => 'nullable|string',
        'specifications.*.value_ar' => 'nullable|string',
    ]);

    $product = Product::create([
        'name' => $request->name,
        'name_ar' => $request->name_ar,
        'small_description' => $request->small_description,
        'small_description_ar' => $request->small_description_ar,
        'description' => $request->description,
        'description_ar' => $request->description_ar,
        'price' => $request->price,
        'price_after_discount' => $request->price_after_discount,
        'quantity' => $request->quantity,
        'sub_category_id' => $request->sub_category_id,
        'brand_id' => $request->brand_id,
        'type' => $request->type,
        'parent_product_id' => $request->type === 'variation' ? $request->parent_product_id : null,
    ]);

    if ($request->hasFile('image')) {
        $images = [];
        foreach ($request->file('image') as $file) {
            try {
                $uploadResult = Cloudinary::upload($file->getRealPath());
                if (!$uploadResult) {
                    return back()->with('error', 'Failed to upload image.');
                }
                $imageUrl = $uploadResult->getSecurePath();

                $images[] = [
                    'image' => $imageUrl,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } catch (\Exception $e) {
                return back()->with('error', 'Image upload error: ' . $e->getMessage());
            }
        }
        ProductImage::insert($images);
    }

    if ($request->filled('specifications')) {
        foreach ($request->specifications as $spec) {
            if (!empty($spec['key']) && !empty($spec['value'])) {
                $product->specifications()->create([
                    'key' => $spec['key'],
                    'key_ar' => $spec['key_ar'] ?? null,
                    'value' => $spec['value'],
                    'value_ar' => $spec['value_ar'] ?? null,
                ]);
            }
        }
    }

    return to_route('products.index')->with('success', 'Product created successfully');
}


    /**
     * Display the specified resource.
     */
public function show(Product $product)
{
    $product->load(['brand', 'images']);

    $productImages = $product->images;
    $product_details = Specification::where('product_id', $product->id)->first();

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
        $product_details = Specification::where('product_id', $product->id)->first();
        $productImages = $product->images;
       $subCategories = SubCategory::where('isDelete', false)->get();
 $brands = Brand::all();

return view('dashboard.products.edit', [
    'product'         => $product,
    'subCategories'   => $subCategories,
    'productImages'   => $productImages,
    'product_details' => $product_details,
    'brands' => $brands
]);

    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Product $product)
{
    $validation = $request->validate([
        'name_ar' => 'required|string',
        'name' => 'required|string',
        'small_description' => 'required|string',
        'small_description_ar' => 'required|string',
        'description' => 'required',
        'description_ar' => 'required',
        'price_after_discount' => 'nullable|numeric',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        'sub_category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'specifications' => 'nullable|array',
        'specifications.*.key' => 'nullable|string',
        'specifications.*.key_ar' => 'nullable|string',
        'specifications.*.value' => 'nullable|string',
        'specifications.*.value_ar' => 'nullable|string',
    ]);

    $product->update([
        'name' => $request->input('name'),
        'name_ar' => $request->input('name_ar'),
        'small_description' => $request->input('small_description'),
        'small_description_ar' => $request->input('small_description_ar'),
        'description' => $request->input('description'),
        'description_ar' => $request->input('description_ar'),
        'price' => $request->input('price'),
        'price_after_discount' => $request->input('price_after_discount'),
        'quantity' => $request->input('quantity'),
        'sub_category_id' => $request->input('sub_category_id'),
        'brand_id' => $request->input('brand_id'),
    ]);

    // رفع الصور
    if ($request->hasFile('image')) {
        $images = [];
        foreach ($request->file('image') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/productImages/');
            $file->move($path, $filename);
            $images[] = [
                'image' => 'uploads/productImages/' . $filename,
                'product_id' => $product->id,
            ];
        }
        ProductImage::insert($images);
    }

    // تحديث المواصفات
    if ($request->has('specifications')) {
        foreach ($request->input('specifications') as $spec) {
            if (!empty($spec['key']) || !empty($spec['value'])) {
                Specification::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => $spec['key'],
                    ],
                    [
                        'key_ar' => $spec['key_ar'] ?? '',
                        'value' => $spec['value'] ?? '',
                        'value_ar' => $spec['value_ar'] ?? '',
                    ]
                );
            }
        }
    }

     return to_route('products.index')->with('success', 'Product updated successfully');
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

    $product->isDelete = true;
    $product->save();

    return to_route('products.index')->with('success', 'Product deleted');
}

}
