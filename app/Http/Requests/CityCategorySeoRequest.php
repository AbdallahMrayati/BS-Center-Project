<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityCategorySeoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'city_id' => 'nullable|exists:cities,id',
            'h1_ar' => 'nullable|string|max:255',
            'h1_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'meta_keywords_ar' => 'nullable|string|max:255',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string|max:255',
            'meta_robots_ar' => 'nullable|string|max:255',
            'meta_robots_en' => 'nullable|string|max:255',
            'meta_image_size' => 'nullable|string|max:255',
            'meta_type_ar' => 'nullable|string|max:255',
            'meta_type_en' => 'nullable|string|max:255',
            'meta_site_name_ar' => 'nullable|string|max:255',
            'meta_site_name_en' => 'nullable|string|max:255',
            'meta_site_ar' => 'nullable|string|max:255',
            'meta_site_en' => 'nullable|string|max:255',
            'meta_local_ar' => 'nullable|string|max:255',
            'meta_local_en' => 'nullable|string|max:255',
            'meta_card_ar' => 'nullable|string|max:255',
            'meta_card_en' => 'nullable|string|max:255',
        ];
    }
}
