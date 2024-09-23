<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'title' => 'string|max:250|nullable',
            'h1' => 'string|max:255|nullable',
            'lang' => 'string|max:5|nullable',
            'description' => 'string|nullable',
            'image_title' => 'string|max:150|nullable',
            'image_alt' => 'string|max:150|nullable',
            'slug' => 'string|max:255|unique:blogs,slug,' . $this->blog,
            'tag_name' => 'string|max:150|nullable',
        ];
    }
}
