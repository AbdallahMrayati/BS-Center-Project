<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMetaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section' => 'required|int',

            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_robots_en' => 'nullable|string|max:255',
            'meta_type_en' => 'nullable|string|max:255',
            'meta_site_name_en' => 'nullable|string|max:255',
            'meta_site_en' => 'nullable|string|max:255',
            'meta_local_en' => 'nullable|string|max:255',
            'meta_card_en' => 'nullable|string',

            'meta_title_ar' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string',
            'meta_keywords_ar' => 'nullable|string|max:255',
            'meta_robots_ar' => 'nullable|string|max:255',
            'meta_type_ar' => 'nullable|string|max:255',
            'meta_site_name_ar' => 'nullable|string|max:255',
            'meta_site_ar' => 'nullable|string|max:255',
            'meta_local_ar' => 'nullable|string|max:255',
            'meta_card_ar' => 'nullable|string',

            'meta_image_size' => 'nullable|string|max:255',
        ];
    }
}
