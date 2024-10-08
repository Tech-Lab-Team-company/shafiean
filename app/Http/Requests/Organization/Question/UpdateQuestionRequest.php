<?php

namespace App\Http\Requests\Organization\Question;

use App\Enum\QuestionTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends ApiRequest
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
            'id' => 'required|integer|exists:questions,id',
            'title' => 'required|string|max:191',
            "type" => 'required|in:' . enumCaseValue(QuestionTypeEnum::class),
            'degree' => 'required|numeric',
            "answers" => "nullable|array",
            "answers.*.title" => "required|string",
            "answers.*.is_correct" => "required|boolean"
        ];
    }
}
