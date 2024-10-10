<?php

namespace App\Http\Requests\Organization\Blog;

use App\Helpers\Response\ApiRequest;

class UpdateBlogRequest extends ApiRequest
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
            'id' => 'required|exists:blogs,id',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'blog_hashtags' => 'array',
            'blog_hashtags.*' => 'exists:blog_hashtags,id',
            'blog_categories' => 'array',
            'blog_categories.*' => 'exists:blog_categories,id'
        ];
    }
}
