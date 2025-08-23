<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories_index', 3600 * 24, function () {
            return Category::where('isDelete', false)->get();
        });

        return response()->json($categories);
    }

    public function productsByCategory($categoryId)
    {
        $products = Cache::remember("category_products_{$categoryId}", 3600, function () use ($categoryId) {
            $category = Category::with([
                'subCategories.products' => function ($query) {
                    $query->where('type', 'main');
                },
                'subCategories.products.images'
            ])
            ->where('id', $categoryId)
            ->where('isDelete', false)
            ->first();

            if (!$category) {
                return null;
            }

            return $category->subCategories->flatMap(function ($subCategory) {
                return $subCategory->products;
            });
        });

        if (is_null($products)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($products);
    }























    // ------------------------------------------------------------------------

public function import(Request $request)
{
    $request->validate([
        'zip_file' => 'required|file|mimes:zip',
    ]);

    $zipFile = $request->file('zip_file');
    $zip = new ZipArchive;

    $tempFolderName = 'import-' . uniqid() . time();
    $tempFolderPath = storage_path('app/temp/' . $tempFolderName);

    try {
        if ($zip->open($zipFile->getRealPath()) === TRUE) {
            $zip->extractTo($tempFolderPath);
            $zip->close();
        } else {
            throw new \Exception('Failed to open the ZIP file.');
        }

        $filesInZip = File::files($tempFolderPath);
        $sheetFile = null;
        foreach ($filesInZip as $file) {
            $extension = $file->getExtension();
            if (in_array($extension, ['xlsx', 'xls', 'csv'])) {
                $sheetFile = $file->getPathname();
                break;
            }
        }

        if (!$sheetFile) {
            throw new \Exception('No Excel or CSV file found inside the ZIP archive.');
        }

        $import = new CategoriesImport($tempFolderPath);
        Excel::import($import, $sheetFile);

        Cache::forget('categories_index');

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred during import.',
            'error' => $e->getMessage()
        ], 422);
    } finally {
        File::deleteDirectory($tempFolderPath);
    }

    return response()->json(['message' => 'File processed and categories imported successfully!'], 200);
}

}
