<?php

namespace App\Http\Controllers\Api;
use App\Imports\BrandsImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
class BrandController extends Controller
{
    public function index()
    {
        $brands = Cache::remember('brands_index', 3600, function () {
            return Brand::select(['id', 'name', 'image'])->get();
        });

        return response()->json($brands);    
    }



    // --------------------------------------------------


public function import(Request $request)
{
    $request->validate([
        'zip_file' => 'required|file|mimes:zip',
    ]);

    $zipFile = $request->file('zip_file');
    $zip = new ZipArchive;
    $tempFolderName = 'import-brands-' . uniqid();
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

        $import = new BrandsImport($tempFolderPath);
        Excel::import($import, $sheetFile);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred during import.',
            'error' => $e->getMessage()
        ], 422);
    } finally {
        File::deleteDirectory($tempFolderPath);
    }

    return response()->json(['message' => 'Brands imported successfully!'], 200);
}

}
