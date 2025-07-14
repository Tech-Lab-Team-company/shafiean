<?php

namespace App\Http\Requests\Course;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditCourseRequest extends ApiRequest
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
            'id' => 'required|exists:courses,id',
            'name' => 'nullable|string|max:191',
            'year_id' => 'nullable|exists:years,id',
            'curriculum_id' => 'nullable|exists:curriculums,id',
            // 'disability_ids' => 'nullable|array|exists:disability_types,id',
            'start_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:end_date',
            ],
            'end_date' => ['nullable', 'date', 'after:start_date', 'date_format:Y-m-d'],
        ];
    }
}
