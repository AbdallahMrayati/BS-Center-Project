<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:250|nullable',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'h1' => 'string|max:255|nullable',
            'lang' => 'required|string|max:5|nullable',
            'description' => 'string|nullable',
            'image_alt' => 'string|max:150|nullable',
            'image_title' => 'string|max:150|nullable',
            'tag_name' => 'string|max:150|nullable',

            'meta_title' => 'string|max:255|nullable',
            'meta_description' => 'string|nullable',
            'meta_keywords' => 'string|nullable',
            'meta_robots' => 'string|nullable',
            'meta_image_size' => 'string|max:255|nullable',
            'meta_type' => 'string|max:255|nullable',
            'meta_site_name' => 'string|max:255|nullable',
            'meta_site' => 'string|max:255|nullable',
            'meta_local' => 'string|max:255|nullable',
            'meta_card' => 'string|max:255|nullable',
        ];
    }
}
