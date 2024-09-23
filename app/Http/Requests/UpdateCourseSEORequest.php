<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseSEORequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_robots' => 'nullable|string',
            'meta_image_size' => 'nullable|string|max:255',
            'meta_type' => 'nullable|string|max:255',
            'meta_site_name' => 'nullable|string|max:255',
            'meta_site' => 'nullable|string|max:255',
            'meta_local' => 'nullable|string|max:255',
            'meta_card' => 'nullable|string|max:255',
        ];
    }
}
