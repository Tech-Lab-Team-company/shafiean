<?php

namespace App\Http\Requests\Organization\Blog;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends ApiRequest
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_hashtags' => 'array',
            'blog_hashtags.*' => 'exists:blog_hashtags,id',
            'blog_categories' => 'array',
            'blog_categories.*' => 'exists:blog_categories,id'
        ];
    }
}
