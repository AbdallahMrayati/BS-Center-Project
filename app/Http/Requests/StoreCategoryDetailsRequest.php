<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:250',
            'lang' => 'required|string|max:5',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp', // Single image
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Multiple images
            'image_alt' => 'nullable|string|max:150',
            'image_title' => 'nullable|string|max:150',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'h1' => 'nullable|string|max:255',
        ];
    }
}
