<?php

namespace App\Http\Requests\Season;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditSeasonRequest extends ApiRequest
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
            'id' => 'required|exists:seasons,id',
            'title' => 'nullable|string|max:191',
            'country_id' => 'nullable|exists:countries,id',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }
}
