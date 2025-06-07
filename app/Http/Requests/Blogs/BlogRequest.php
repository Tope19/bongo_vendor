<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|min:3',
            'caption' => 'required|min:3',
            'cover_image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|min:3',
        ];
    }
}
