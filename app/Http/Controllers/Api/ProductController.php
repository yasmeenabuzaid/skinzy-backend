<?php

// app/Http/Controllers/Api/ProductController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Cache; // <-- ١. إضافة Cache

class ProductController extends Controller
{
    public function index()
    {
        // ٢. تغليف المنطق الأصلي داخل Cache::remember
        $products = Cache::remember('products_index', 3600, function () {
            // -- المنطق الأصلي الخاص بك كما هو --
            return Product::with(['images', 'subCategory'])
                ->where('type', 'main')
                ->get();
            // -- نهاية المنطق الأصلي --
        });

        return response()->json($products);
    }

    public function getProductsBySubCategory($subcategoryId)
    {
        if (!$subcategoryId) {
            return response()->json(['error' => 'subcategory_id parameter is required'], 400);
        }

        $products = Cache::remember("products_subcategory_{$subcategoryId}", 3600, function () use ($subcategoryId) {
            // -- المنطق الأصلي الخاص بك كما هو --
            return Product::with(['images', 'subCategory'])
                ->where('sub_category_id', $subcategoryId)
                ->where('isDelete', 0)
                ->where('type', 'main')
                ->get();
            // -- نهاية المنطق الأصلي --
        });

        return response()->json($products);
    }

    public function getProductsByBrand($brandId)
    {
        if (!$brandId) {
            return response()->json(['error' => 'brand_id parameter is required'], 400);
        }

        $products = Cache::remember("products_brand_{$brandId}", 3600, function () use ($brandId) {
            // -- المنطق الأصلي الخاص بك كما هو --
            return Product::with(['images', 'subCategory'])
                ->where('brand_id', $brandId)
                ->where('type', 'main')
                ->get();
            // -- نهاية المنطق الأصلي --
        });

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Cache::remember("product_show_{$id}", 3600, function () use ($id) {
            // -- المنطق الأصلي الخاص بك كما هو --
            $product = Product::with([
                'images', 'specifications', 'variations.images', 'variations.specifications',
                'parentProduct.images', 'parentProduct.specifications', 'parentProduct.variations.images',
                'parentProduct.variations.specifications', 'subCategory', 'brand',
            ])->where('id', $id)->first();

            if ($product && $product->type === 'variation' && $product->parentProduct) {
                $product->parent = $product->parentProduct;
                $product->siblings = $product->parentProduct->variations->where('id', '!=', $product->id)->values();
            }

            return $product;
            // -- نهاية المنطق الأصلي --
        });

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
}
