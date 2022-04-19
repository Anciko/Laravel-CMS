<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            "title" => "required",
            "content" => "required|min:20",
            "image" => "image|mimes:png,jpg,jpeg",
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
