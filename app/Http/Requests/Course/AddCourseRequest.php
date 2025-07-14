<?php

namespace App\Http\Requests\Course;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddCourseRequest extends ApiRequest
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
            'name' => 'required|string|max:191',
            'year_id' => 'required|exists:years,id',
            'season_id' => 'required|exists:seasons,id',
            'curriculum_id' => 'nullable|exists:curriculums,id',
            // 'disability_ids' => 'required|array|exists:disability_types,id',
            'stage_ids' => 'required_if:all_curriculum,0|array|exists:stages,id',
            'all_curriculum' => 'nullable|integer|in:0,1',
            'start_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:end_date',
            ],
            'end_date' => ['required', 'date', 'after:start_date', 'date_format:Y-m-d'],
        ];
    }
}
