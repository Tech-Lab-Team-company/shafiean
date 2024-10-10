<?php

namespace App\Http\Requests\Organization\Landingpage\Subheader;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationAddSubheaderRequest extends ApiRequest
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
            'title' => 'required|string|max:191',
            'subtitle' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ];
    }
}
