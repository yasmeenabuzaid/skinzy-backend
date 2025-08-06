<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images', 'subCategory'])
            ->where('type', 'main')
            ->get();

        return response()->json($products);
    }

    public function getProductsBySubCategory($subcategoryId)
    {
        if (!$subcategoryId) {
            return response()->json([
                'error' => 'subcategory_id parameter is required'
            ], 400);
        }

        $products = Product::with(['images', 'subCategory'])
            ->where('sub_category_id', $subcategoryId)
            ->where('isDelete', 0)
            ->where('type', 'main')
            ->get();

        return response()->json($products);
    }

    public function getProductsByBrand($brandId)
    {
        if (!$brandId) {
            return response()->json([
                'error' => 'brand_id parameter is required'
            ], 400);
        }

        $products = Product::with(['images', 'subCategory'])
            ->where('brand_id', $brandId)
            ->where('type', 'main')
            ->get();

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with([
            'images',
            'specifications',
            'variations.images',
            'variations.specifications',
            'parentProduct.images',
            'parentProduct.specifications',
            'parentProduct.variations.images',
            'parentProduct.variations.specifications',
            'subCategory',
        ])->where('id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if ($product->type === 'variation' && $product->parentProduct) {
            $product->parent = $product->parentProduct;
            $product->siblings = $product->parentProduct->variations->where('id', '!=', $product->id)->values();
        }

        return response()->json($product);
    }
}
