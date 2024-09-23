<?php

// app/Http/Requests/StoreTimingRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'course_id' => 'nullable|exists:courses,id',
            'city_id' => 'required|exists:cities,id',
            'title' => 'nullable|string|max:250',
            'price' => 'nullable|numeric|min:0',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
            'duration' => 'nullable|int|max:255',
            'lang' => 'nullable|string|max:5',
            'is_upcoming' => 'boolean',
            'is_banner' => 'boolean',
        ];
    }
}
