<?php

namespace App\Http\Requests\Organization\Exam\GroupExamQuestion;



use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupExamQuestionAnswerRequest extends ApiRequest
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
            'answer_id' => 'required|exists:answers,id',
            'is_correct' => 'required|boolean',
            'answer' => 'required|max:255',
        ];
    }
}
