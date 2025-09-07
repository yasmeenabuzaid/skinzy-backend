<?php

namespace App\Http\Controllers\Api;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\GetProductsRequest;
class ProductController extends Controller
{
    public function getProducts(GetProductsRequest $request)
    {
        $subcategoryId = $request->sub_category_id;
        $brandId = $request->brand_id;
        $categoryId    = $request->category_id;

        // Fetch the products
        $query = Product::select([
                    'id', 'name', 'small_description', 'name_ar', 
                    'small_description_ar', 'price', 'price_after_discount','type'
                ])
                ->where('type', 'main')
                ->with(['images:id,image,product_id']);

        // Sort by subcategory if the sub_category_id send 
        if ($subcategoryId) {
            $query->where('sub_category_id', $subcategoryId);
        }

        // Sort by brand if the brand_id send 
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        // Sort by category if the category_id send (by this relation: Product->subCategory->category)
        if ($categoryId) {
            $query->whereHas('subCategory', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        //Pagination for the products
        $products = $query->paginate(20);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Cache::remember("product_show_{$id}", 3600, function () use ($id) {
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
        });

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }




// ---------------------------------------ظ

public function import(Request $request)
{
    $request->validate(['zip_file' => 'required|file|mimes:zip']);

    $zipFile = $request->file('zip_file');
    $zip = new ZipArchive;
    $tempFolderName = 'import-products-' . uniqid();
    $tempFolderPath = storage_path('app/temp/' . $tempFolderName);

    try {
        if ($zip->open($zipFile->getRealPath()) === TRUE) {
            $zip->extractTo($tempFolderPath);
            $zip->close();
        } else {
            throw new \Exception('Failed to open the ZIP file.');
        }

        $sheetFile = null;
        foreach (File::files($tempFolderPath) as $file) {
            if (in_array($file->getExtension(), ['xlsx', 'xls', 'csv'])) {
                $sheetFile = $file->getPathname();
                break;
            }
        }

        if (!$sheetFile) {
            throw new \Exception('No Excel or CSV file found inside the ZIP archive.');
        }

        Excel::import(new ProductsImport($tempFolderPath), $sheetFile);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred during import.',
            'error' => $e->getMessage()
        ], 422);
    } finally {
        File::deleteDirectory($tempFolderPath);
    }

    return response()->json(['message' => 'Products imported successfully!'], 200);
}

}
