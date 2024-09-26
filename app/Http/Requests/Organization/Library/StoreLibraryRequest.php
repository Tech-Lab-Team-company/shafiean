<?php

namespace App\Http\Requests\Organization\Library;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreLibraryRequest extends ApiRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
        ];
    }
}
