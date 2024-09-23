<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Download;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DownloadController extends Controller
{
    public function store(Request $request)
    {
        Log::info("Entered store method.");

        try {
            Log::info("Validating request data...");
            $validatedData = $request->validate([
                'course_id'    => 'nullable|exists:courses,id',
                'name'         => 'nullable|string|max:255',
                'email'        => 'nullable|string|email|max:255',
                'phone'        => 'nullable|string|max:255',
                'company_name' => 'nullable|string|max:255',
            ]);

            Log::info("Validation passed. Creating download record...");
            $download = Download::create($validatedData);

            Log::info("Download created successfully with ID: " . $download->id);

            return redirect()->back()->with('success', 'Download form submitted successfully.');
        } catch (ValidationException $e) {
            Log::error("Validation failed: " . $e->getMessage());
            return redirect()->back()->withErrors($e)->withInput();
        } catch (\Exception $e) {
            Log::error("An error occurred: " . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

}
