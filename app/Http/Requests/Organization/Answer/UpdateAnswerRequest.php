<?php

namespace App\Http\Requests\Organization\Answer;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends ApiRequest
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
            'id' => 'required|exists:answers,id',
            'answer' => 'required|string',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|exists:questions,id',
        ];
    }
}
