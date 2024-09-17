<?php

namespace App\Http\Requests\Group;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditGroupRequest extends ApiRequest
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
            'id' => 'required|exists:groups,id',
            'title' => 'nullable|string',
            'course_id' => 'nullable|exists:courses,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'with_all_disability' => 'nullable|integer',
            'with_all_course_content' => 'nullable|integer',
        ];
    }
}
