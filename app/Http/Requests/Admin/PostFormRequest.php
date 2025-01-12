<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'yt_iframe' => [
                'nullable',
                'string',
                'regex:/^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/',
            ],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'The selected category does not exist.',
            'name.required' => 'Post name is required.',
            'name.string' => 'Post name must be a valid string.',
            'name.max' => 'Post name may not exceed 255 characters.',
            // 'name.unique' => 'A post with this name already exists.',
            'yt_iframe.regex' => 'The YouTube link must be a valid URL.',
            'meta_title.max' => 'Meta title may not exceed 255 characters.',
            'meta_description.max' => 'Meta description may not exceed 500 characters.',
            'meta_keyword.max' => 'Meta keyword may not exceed 255 characters.',
        ];
    }

    // public function rules()
    // {
    //     $rules = [
    //         'category_id' => ['required', 'integer'],
    //         'name' => ['required', 'string'],
    //         'slug' => ['nullable', 'string'],
    //         'description' => ['required'],
    //         'yt_iframe' => ['nullable', 'string'],
    //         'meta_title' => ['nullable', 'string'],
    //         'meta_description' => ['nullable', 'string'],
    //         'meta_keyword' => ['nullable', 'string'],
    //         'status' => ['nullable']
    //     ];

    //     return $rules;
    // }
}
