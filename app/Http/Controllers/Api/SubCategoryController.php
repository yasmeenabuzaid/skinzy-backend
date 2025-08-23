<?php
namespace App\Http\Controllers\Api;
use App\Imports\SubCategoriesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Cache::remember('subcategories_index', 3600 * 24, function () { // تخزين لمدة يوم
            return SubCategory::where('isDelete', false)->get();
        });

        return response()->json($subcategories);
    }

    public function getWithSubcategories()
    {
        $categories = Cache::remember('categories_with_subcategories', 3600, function () {
            return Category::select('id', 'name', 'name_ar')
                ->where('isDelete', false)
                ->with(['subcategories' => function ($query) {
                    $query->select('id', 'category_id', 'name', 'name_ar')
                          ->where('isDelete', false);
                }])
                ->get();
        });

        return response()->json($categories);
    }

public function import(Request $request)
{
    $request->validate(['zip_file' => 'required|file|mimes:zip']);

    $zipFile = $request->file('zip_file');
    $zip = new ZipArchive;
    $tempFolderName = 'import-subcategories-' . uniqid();
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
            if (in_array($file->getExtension(), ['xlsx', 'xls', 'csv'])) {
                $sheetFile = $file->getPathname();
                break;
            }
        }

        if (!$sheetFile) {
            throw new \Exception('No Excel or CSV file found inside the ZIP archive.');
        }

        Excel::import(new SubCategoriesImport, $sheetFile);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred during import.',
            'error' => $e->getMessage()
        ], 422);
    } finally {
        File::deleteDirectory($tempFolderPath);
    }

    return response()->json(['message' => 'Sub-Categories imported successfully!'], 200);
}

}
