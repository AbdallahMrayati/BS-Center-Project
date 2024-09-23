<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('screen.contact');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:150',
            'email' => 'nullable|string|max:150|email',
            'phone_number' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:150',
            'subject' => 'nullable|string|max:150',
            'message' => 'nullable|string',
        ]);

        ContactUs::create($validatedData);

        return redirect()->back()->with('success', 'Contact form submitted successfully.');
    }
}
