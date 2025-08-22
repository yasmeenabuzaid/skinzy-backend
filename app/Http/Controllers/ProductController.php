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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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


  public function bulkCreate()
    {
        $subCategories = SubCategory::where('isDelete', false)->get();
        $brands = Brand::all();

        return view('dashboard.products.bulk-create', [
            'subCategories' => $subCategories,
            'brands' => $brands,
        ]);
    }

    /**
     * Store multiple newly created products in storage.
     */
     public function bulkStore(Request $request)
    {
        // 1. التحقق من صحة البيانات بنفس قواعد دالة store ولكن لكل عنصر في المصفوفة
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.name' => 'required|string',
            'products.*.name_ar' => 'required|string',
            'products.*.code' => 'nullable|string',
            'products.*.small_description' => 'required|string',
            'products.*.small_description_ar' => 'required|string',
            'products.*.description' => 'required',
            'products.*.description_ar' => 'required',
            'products.*.price' => 'required|numeric',
            'products.*.price_after_discount' => 'nullable|numeric',
            'products.*.sub_category_id' => 'required|exists:sub_categories,id',
            'products.*.brand_id' => 'required|exists:brands,id',
            'products.*.type' => 'required|in:main,variation',
            'products.*.parent_product_id' => 'nullable|exists:products,id',
            'products.*.specifications' => 'nullable|array',
            'products.*.specifications.*.key' => 'nullable|string',
            'products.*.specifications.*.key_ar' => 'nullable|string',
            'products.*.specifications.*.value' => 'nullable|string',
            'products.*.specifications.*.value_ar' => 'nullable|string',
            // ملاحظة: التحقق من الصور في الإدخال الجماعي يتطلب معالجة خاصة في الواجهة الأمامية
            // غالبًا ما يتم إرسال أسماء الملفات أو روابطها بدلاً من رفعها مباشرة هنا
        ]);

        // 2. استخدام Transaction لضمان سلامة البيانات
        try {
            DB::transaction(function () use ($validated, $request) {
                // استبدلنا $validated['products'] بـ $request->products للحصول على كل البيانات
                foreach ($request->products as $index => $productData) {
                    // 3. إنشاء المنتج الرئيسي (نفس منطق store)
                    $product = Product::create([
                        'name' => $productData['name'],
                        'code' => $productData['code'] ?? null,
                        'name_ar' => $productData['name_ar'],
                        'small_description' => $productData['small_description'],
                        'small_description_ar' => $productData['small_description_ar'],
                        'description' => $productData['description'],
                        'description_ar' => $productData['description_ar'],
                        'price' => $productData['price'],
                        'price_after_discount' => $productData['price_after_discount'] ?? null,
                        'sub_category_id' => $productData['sub_category_id'],
                        'brand_id' => $productData['brand_id'],
                        'type' => $productData['type'],
                        'parent_product_id' => ($productData['type'] === 'variation') ? $productData['parent_product_id'] : null,
                    ]);

                    // 4. معالجة المواصفات (Specifications) للمنتج الحالي
                    if (!empty($productData['specifications'])) {
                        foreach ($productData['specifications'] as $spec) {
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

                    // 5. معالجة الصور (إذا تم إرسالها)
                    // هذا الجزء يعتمد على كيفية إرسال الصور من الواجهة الأمامية
                    // نفترض هنا أنك ترسل الصور بنفس طريقة store ولكن داخل مصفوفة products
                    if ($request->hasFile("products.{$index}.image")) {
                        $images = [];
                        foreach ($request->file("products.{$index}.image") as $file) {
                            $uploadResult = Cloudinary::upload($file->getRealPath());
                            if (!$uploadResult) {
                                // يمكنك إيقاف العملية هنا إذا فشل رفع الصورة
                                throw new \Exception('Failed to upload image.');
                            }
                            $imageUrl = $uploadResult->getSecurePath();
                            $images[] = [
                                'image' => $imageUrl,
                                'product_id' => $product->id,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                        ProductImage::insert($images);
                    }
                }
            });
        } catch (\Exception $e) {
            Log::error('Bulk Store Failed: ' . $e->getMessage());
            // إرجاع رسالة خطأ مفصلة أكثر في حالة التطوير
            return back()->with('error', 'An error occurred while saving the products. Error: ' . $e->getMessage());
        }

        return to_route('products.index')->with('success', 'Products created successfully!');
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
        'code' => 'nullable|string',
        'name_ar' => 'required|string',
        'small_description' => 'required|string',
        'small_description_ar' => 'required|string',
        'description' => 'required',
        'description_ar' => 'required',
        'price_after_discount' => 'nullable|numeric',
        'price' => 'required|numeric',
        // 'quantity' => 'required|integer|min:1',
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
        'code' => $request->code,
        'name_ar' => $request->name_ar,
        'small_description' => $request->small_description,
        'small_description_ar' => $request->small_description_ar,
        'description' => $request->description,
        'description_ar' => $request->description_ar,
        'price' => $request->price,
        'price_after_discount' => $request->price_after_discount,
        // 'quantity' => $request->quantity,
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
                'code' => 'nullable|string',

        'name' => 'required|string',
        'small_description' => 'required|string',
        'small_description_ar' => 'required|string',
        'description' => 'required',
        'description_ar' => 'required',
        'price_after_discount' => 'nullable|numeric',
        'price' => 'required|numeric',
        // 'quantity' => 'required|integer|min:1',
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
        'code' => $request->input('code'),
        'name_ar' => $request->input('name_ar'),
        'small_description' => $request->input('small_description'),
        'small_description_ar' => $request->input('small_description_ar'),
        'description' => $request->input('description'),
        'description_ar' => $request->input('description_ar'),
        'price' => $request->input('price'),
        'price_after_discount' => $request->input('price_after_discount'),
        // 'quantity' => $request->input('quantity'),
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
