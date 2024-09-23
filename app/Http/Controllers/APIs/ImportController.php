<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ImportDataJob;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class ImportController extends Controller
{
    public function process(Request $request)
    {
        try {
            Log::info("From process: controller");

            $request->validate([
                'file' => 'required|file|mimes:xls,xlsx',
            ]);

            $file = $request->file('file');
            $filePath = $file->storeAs('imports', $file->getClientOriginalName());

            // Use the full path
            $fullPath = storage_path('app/' . $filePath);

            // Log the full path for debugging
            Log::info('File stored at: ' . $fullPath);

            // Dispatch the import job with the full path
            ImportDataJob::dispatch($fullPath);

            return response()->json(['message' => 'File uploaded and import job started']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to import file.', 'message' => $e->getMessage()], 500);
        }
    }


    public function progress()
    {
        // Retrieve the import status from cache
        $importStatus = Cache::get('import_status', 'No import in progress');

        // Return the status as JSON response
        return response()->json(['status' => $importStatus]);
    }

    public function clearStatus()
    {
        // Clear the import status from cache
        Cache::put('import_status', 'The import is in progress');

        // Return a response if needed
        return response()->json(['message' => 'Import status cleared']);
    }

    public function download()
    {
        // Define the path to your standard Excel file
        $filePath = public_path('excel/standard.xlsx');

        // Check if the file exists
        if (file_exists($filePath)) {
            // Prepare the response for file download
            return Response::download($filePath, 'standard_excel_file.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
        } else {
            // If the file does not exist, return a 404 response
            return response()->json(['message' => 'File not found'], 404);
        }
    }

    public function truncateTables()
    {
        try {
            // Disable foreign key checks to allow truncating tables with relationships
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Truncate the tables
            DB::table('timings')->truncate();
            DB::table('cities')->truncate();
            DB::table('courses')->truncate();
            DB::table('categories')->truncate();

            // Enable foreign key checks again
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return response()->json([
                'message' => 'Tables truncated successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to truncate tables.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}