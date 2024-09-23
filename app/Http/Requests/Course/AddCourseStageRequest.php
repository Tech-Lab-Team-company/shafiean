<?php

namespace App\Http\Requests\Course;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddCourseStageRequest extends ApiRequest
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
            'course_id' => 'required|integer|exists:courses,id',
            'stages' => 'required|array',
            'stages.*.stage_id' => 'required|integer|exists:stages,id',
            'stages.*.sessions' => 'required|array',
            'stages.*.sessions.*.session_id' => 'required|integer|exists:main_sessions,id',
            'stages.*.sessions.*.with_edit' => 'required|boolean',
            'stages.*.sessions.*.start_verse' => 'nullable|integer',
            'stages.*.sessions.*.end_verse' => 'nullable|integer',
            'stages.*.sessions.*.session_type_id' => 'required|integer|exists:session_types,id',
        ];
    }
}
