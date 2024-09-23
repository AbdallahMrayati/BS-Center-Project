<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'nullable|string|max:999',
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $this->course,
            'h1' => 'nullable|string|max:255',
            'lang' => 'nullable|string|max:5',
            'overview' => 'nullable|string',
            'description' => 'nullable|string',
            'objectives' => 'nullable|string',
            'brief' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp', // Single image
            'image_alt' => 'nullable|string|max:150',
            'image_title' => 'nullable|string|max:150',
        ];
    }
}
