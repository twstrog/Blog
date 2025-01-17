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
            'description' => 'required|string|max:20000',
            'yt_iframe' => [
                'nullable',
                'string',
                'regex:/^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/',
            ],
            'meta_title' => 'required|string|max:60',
            'meta_description' => 'required|string|max:160',
            'meta_keyword' => 'required|string|max:100',
            'status' => 'nullable',
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
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a valid string.',
            'description.max' => 'Description may not exceed 20000 characters.',
            'yt_iframe.regex' => 'The YouTube link must be a valid URL.',
            'meta_title.required' => 'Meta title is required.',
            'meta_title.max' => 'Meta title may not exceed 60 characters.',
            'meta_description.required' => 'Meta description is required.',
            'meta_description.max' => 'Meta description may not exceed 160 characters.',
            'meta_keyword.required' => 'Meta keyword is required.',
            'meta_keyword.max' => 'Meta keyword may not exceed 100 characters.',
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
