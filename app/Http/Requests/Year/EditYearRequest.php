<?php

namespace App\Http\Requests\Year;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditYearRequest extends ApiRequest
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
            'id' => 'required|exists:years,id',
            'title' => 'nullable|string|max:191',
            'country_id' => 'nullable|exists:countries,id',
            'organization_id' => 'nullable|exists:organizations,id',
            'start_date' => [
                'nullable',
                'date',
                'date_format:d/m/Y',
                'before_or_equal:end_date',
            ],
            'end_date' => ['nullable', 'date', 'after:start_date', 'date_format:d/m/Y'],
            // 'hijri_start_date' => 'nullable|string',
            // 'hijri_end_date' => 'nullable|string',
        ];
    }
}
