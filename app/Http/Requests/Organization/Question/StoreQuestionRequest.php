<?php

namespace App\Http\Requests\Organization\Question;

use App\Enum\QuestionTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends ApiRequest
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
            "questions" => "required|array",
            "questions.*.title" => "required|string",
            "questions.*.type" => 'required|in:' . enumCaseValue(QuestionTypeEnum::class),
            "questions.*.degree" => 'required|numeric',
            "questions.*.answers" => "required|array",
            "questions.*.answers.*.title" => "required|string",
            "questions.*.answers.*.is_correct" => "required|boolean"
        ];
    }
}
