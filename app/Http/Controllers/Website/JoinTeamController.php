<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\JoinTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JoinTeamController extends Controller
{
    public function index()
    {
        return view('screen.joinOurTeam');
    }

    public function store(Request $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'nullable|string|max:150',
            'phone_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:150',
            'cv' => 'nullable|file|mimes:pdf,doc,docx',
            'speciality' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:150',
        ]);

        // Handle file upload
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_uploads', 'public');
            $validatedData['cv'] = $cvPath;
        }

        // Store the data in the database
        $joinTeam = JoinTeam::create($validatedData);

        // Redirect with success message
        return redirect()->back()->with('success', 'Join Team form submitted successfully.');
    } catch (\Exception $e) {
        // Log the exception
        Log::error('Join Team form submission failed: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->with('error', 'There was an issue with your submission. Please try again.');
    }
}

}
