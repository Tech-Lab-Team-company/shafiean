<?php

namespace App\Http\Requests\User\ExamResultAnswer;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamResultAnswerRequest extends ApiRequest
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
            "exam_id" => "required|exists:exams,id",
            "question_id" => "required|exists:questions,id",
            "answer_id" => "required|exists:answers,id",
            "grade" => "nullable|numeric",

        ];
    }
}
