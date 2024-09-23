<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\RequestInHouse;
use Illuminate\Http\Request;

class RequestInHouseController extends Controller
{
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        return view('screen.requestInHouse', compact('course'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'course_id'    => 'nullable|exists:courses,id',
            'location' => 'nullable|string|max:150',
            'number_of_days' =>'nullable|int',
            'number_of_participants' => 'nullable|int',
            'message1' => 'nullable|string',
            'full_name' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:150',
            'email' => 'nullable|string|max:150|email',
            'phone_number' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:150',
            'subject' => 'nullable|string|max:150',
            'message2' => 'nullable|string',
        ]);

        // Create a new registration form record
        $form = RequestInHouse::create($validatedData);

        // Redirect or respond with success message
        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

}
