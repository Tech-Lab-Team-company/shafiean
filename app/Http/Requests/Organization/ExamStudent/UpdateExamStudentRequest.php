<?php

namespace App\Http\Requests\Organization\ExamStudent;

use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExamStudentRequest extends ApiRequest
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
            'id' => 'required|exists:exam_students,id',
            'exam_id' => ['required', 'integer',   Rule::exists('exams', 'id')->whereNull('deleted_at')],
            'user_id' => ['required', 'integer',   Rule::exists('users', 'id')->whereNull('deleted_at')],
            'grade' => 'required',
            'is_pass' => 'required',
        ];
    }
}
