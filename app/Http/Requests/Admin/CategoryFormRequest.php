<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,jpg,png, gif',
            'meta_title' => 'required|string|max:60',
            'meta_description' => 'required|string|max:160',
            'meta_keyword' => 'required|string|max:100',
            'navbar_status' => 'nullable',
            'status' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be a valid string.',
            'name.max' => 'Category name may not exceed 255 characters.',
            // 'slug.string' => 'Slug must be a valid string.',
            // 'slug.max' => 'Slug may not exceed 200 characters.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a valid string.',
            'description.max' => 'Description may not exceed 255 characters.',
            'image.mimes' => 'Image must be a file of type: jpeg, jpg, png, gif.',
            'meta_title.required' => 'Meta title is required.',
            'meta_title.string' => 'Meta title must be a valid string.',
            'meta_title.max' => 'Meta title may not exceed 60 characters.',
            'meta_description.required' => 'Meta description is required.',
            'meta_description.string' => 'Meta description must be a valid string.',
            'meta_description.max' => 'Meta description may not exceed 160 characters.',
            'meta_keyword.required' => 'Meta keyword is required.',
            'meta_keyword.string' => 'Meta keyword must be a valid string.',
            'meta_keyword.max' => 'Meta keyword may not exceed 100 characters.',
        ];
    }
}
