<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogSEORequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
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
