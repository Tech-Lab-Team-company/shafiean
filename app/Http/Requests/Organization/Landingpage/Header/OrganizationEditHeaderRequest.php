<?php

namespace App\Http\Requests\Organization\Landingpage\Header;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationEditHeaderRequest extends ApiRequest
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
            'id' => 'required|exists:headers,id',
            'title' => 'nullable|string|max:191',
            'subtitle' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ];
    }
}
