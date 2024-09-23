<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\RequestOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestOnlineController extends Controller
{
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        return view('screen.requestOnline', compact('course'));
    }

    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info($request->all());

        // Validate the incoming request
        $validatedData = $request->validate([
            'course_id'    => 'nullable|exists:courses,id',
            'category_id'  => 'nullable|exists:categories,id',
            'full_name'    => 'nullable|string|max:150',
            'email'        => 'nullable|string|max:150|email',
            'phone_number' => 'nullable|string|max:50',
            'company_name' => 'nullable|string|max:150',
            'subject'      => 'nullable|string|max:150',
            'location'     => 'nullable|string|max:150',
            'date'         => 'nullable|date',
            'message'      => 'nullable|string',
        ]);

        // Log the validated data to see if all fields pass validation
        Log::info($validatedData);

        // Create a new registration form record
        $form = RequestOnline::create($validatedData);

        // Redirect or respond with success message
        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

}
