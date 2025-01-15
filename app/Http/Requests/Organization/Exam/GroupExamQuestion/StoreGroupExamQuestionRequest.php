<?php

namespace App\Http\Requests\Organization\Exam\GroupExamQuestion;



use App\Enum\ExamTypeEnum;
use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreGroupExamQuestionRequest extends ApiRequest
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
            'exam_id' => [
                'required',
                'integer',
                Rule::exists('exams', 'id')->whereNull('deleted_at'),
            ],
            'question' => 'required|max:255',
            'type' => 'nullable|in:' . enumCaseValue(ExamTypeEnum::class),
            'degree' => 'nullable|integer',
            'answers' => 'required|array',
            'answers.*.answer' => 'required|max:255',
            'answers.*.is_correct' => 'required|boolean',
        ];
    }
}
