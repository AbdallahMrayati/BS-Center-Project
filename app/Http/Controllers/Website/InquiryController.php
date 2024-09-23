<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InquiryController extends Controller
{
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        return view('screen.enquireNow', compact('course'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id'    => 'nullable|exists:courses,id',
            'full_name'    => 'nullable|string|max:150',
            'email'        => 'nullable|email|max:150',
            'phone_number' => 'nullable|string|max:50',
            'company'      => 'nullable|string|max:150',
            'city'         => 'nullable|string|max:150',
            'message'      => 'nullable|string',
        ]);

        $inquiry = Inquiry::create($validatedData);

        return redirect()->back()->with('success', 'Inquiry form submitted successfully.');
    }

}
