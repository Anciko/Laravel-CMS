<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => "required|unique:posts",
            "content" => "required|min:20",
            "image" => "required|image|mimes:png,jpg,jpeg",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Post title should not be empty!",
            "content.required" => "Post content should not be empty and must be at least 20 characters!"
        ];
    }
}
