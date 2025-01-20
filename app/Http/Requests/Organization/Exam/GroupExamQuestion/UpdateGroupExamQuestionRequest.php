<?php

namespace App\Http\Requests\Organization\Exam\GroupExamQuestion;

use App\Enum\ExamTypeEnum;
use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;

class UpdateGroupExamQuestionRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'question_id' => 'required|exists:questions,id',
            'question' => 'required|max:255',
            'type' => 'nullable|in:' . enumCaseValue(ExamTypeEnum::class),
            'degree' => 'nullable|integer',
            'answers' => 'required|array',
            'answers.*.answer' => 'required|max:255',
            'answers.*.is_correct' => 'required|boolean',
        ];
    }
}
