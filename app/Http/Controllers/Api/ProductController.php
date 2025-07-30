<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images'])
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

        $products = Product::with('images')
            ->where('sub_category_id', $subcategoryId)
            ->where('isActive', 1)
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

    $products = Product::with('images')
        ->where('brand_id', $brandId)
        ->get();

    return response()->json($products);
}



    public function show($id)
    {
        $product = Product::with([
            'images',
            'details',
            'variations.images',
            'variations.details',
            'parentProduct.images',
            'parentProduct.details',
            'parentProduct.variations.images',
            'parentProduct.variations.details',
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
