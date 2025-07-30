<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductImageController extends Controller
{

public function destroy(ProductImage $productImage)
{
    $productId = $productImage->product_id;

    $url = $productImage->url;

    $parsedUrl = parse_url($url, PHP_URL_PATH);
    $pathParts = explode('/', $parsedUrl);

    $filenameWithExtension = end($pathParts);
    $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

    $publicId = 'your_folder/' . $filename;

    Cloudinary::destroy($publicId);

    $productImage->delete();

    return redirect()->route('products.edit', ['product' => $productId])
        ->with('success', 'Product image deleted successfully.');
}

}
