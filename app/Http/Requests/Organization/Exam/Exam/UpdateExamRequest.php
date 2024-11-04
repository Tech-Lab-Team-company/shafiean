<?php

namespace App\Http\Requests\Organization\Exam\Exam;


use App\Enum\ExamTypeEnum;
use App\Enum\DegreeTypeEnum;
use App\Enum\QuestionTypeEnum;
use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends ApiRequest
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
            'id' => 'required|exists:exams,id',
            'name' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:date:start_time',
            'duration' => 'required|date_format:H:i',
            // 'question_count' => 'required|numeric',
            // 'exam_type' => 'required|numeric|in:' . enumCaseValue(ExamTypeEnum::class),
            // 'degree_type' => 'required|numeric|in:' . enumCaseValue(DegreeTypeEnum::class),
            // 'degree' => 'required|numeric',
            'group_ids' => 'required|array',
            'group_ids.*' => ['required', Rule::exists('groups', 'id')->whereNull('deleted_at')],
            'bank_question_ids' => 'nullable|array',
            'bank_question_ids.*' => ['nullable', Rule::exists('questions', 'id')->whereNull('deleted_at')],
            "questions" => "nullable|array",
            // "questions.*.id" => ['required', Rule::exists('questions', 'id')->whereNull('deleted_at')],
            "questions.*.question" => "required|string",
            "questions.*.type" => "required|in:" . enumCaseValue(QuestionTypeEnum::class),
            "questions.*.degree" => "required|numeric",
            "questions.*.answers" => "required|array",
            "questions.*.answers.*.answer" => "required|string",
            "questions.*.answers.*.is_correct" => "required|boolean",
        ];
    }
}
