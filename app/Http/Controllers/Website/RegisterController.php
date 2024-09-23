<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Register;
use App\Models\Timing;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Ramsey\Uuid\Type\Time;

class RegisterController extends Controller
{
    public function index($id)
    {
        $timing = Timing::with('course')->findOrFail($id);

        return view('screen.registration', compact('timing'));
    }

    public function store(Request $request)
    {
        // return $request;
        // Validate the incoming request
        $validatedData = $request->validate([
            'timing_id'             => 'nullable|exists:timings,id',
            'full_name'             => 'nullable|string|max:150',
            'email'                 => 'nullable|email|max:150',
            'phone_number'          => 'nullable|string|max:50',
            'position'              => 'nullable|string|max:150',
            'company_name'          => 'nullable|string|max:150',
            'city'                  => 'nullable|string|max:150',
            'address'               => 'nullable|string|max:150',
            'instructor_name'       => 'nullable|string|max:150',
            'instructor_email'      => 'nullable|email|max:150',
            'instructor_phone_number' => 'nullable|string|max:50',
            'instructor_position'   => 'nullable|string|max:150',
        ]);

        // Create a new registration form record
        $registerForm = Register::create($validatedData);

        // Redirect or respond with success message
        return redirect()->back()->with('success', 'Registration form submitted successfully.');
    }
}