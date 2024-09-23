<?php

// app/Http/Requests/UpdateTimingRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'selected_timings' => 'required|array|min:1',
            'selected_timings.*' => 'integer|exists:timings,id',

            // Validation rules for other fields
            'city_id' => 'nullable|integer|exists:cities,id',  // Ensures the city_id exists in the cities table
            'title' => 'nullable|string|max:250',
            'price' => 'nullable|numeric|min:0',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'duration' => 'int|string|max:255',
        ];
    }

}
