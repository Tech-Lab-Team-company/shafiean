<?php

namespace App\Http\Requests\Organization\Exam\GroupExamQuestion;



use App\Enum\ExamTypeEnum;
use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupExamQuestionRequest extends ApiRequest
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
            'question_id' => 'required|exists:questions,id',
            'question' => 'required|max:255',
            'type' => 'required|in:' . enumCaseValue(ExamTypeEnum::class),
            'degree' => 'required|integer',

        ];
    }
}
