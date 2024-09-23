<?php

// app/Http/Requests/UpdateCityRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lang' => 'nullable|string|max:5',
            'title' => 'nullable|string|max:250',
            'slug' => 'nullable|string|max:255|unique:cities,slug,' . $this->city,
            'h1' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hidden' => 'boolean',
            'image_title' => 'nullable|string|max:150',
            'image_alt' => 'nullable|string|max:255',
        ];
    }

}
