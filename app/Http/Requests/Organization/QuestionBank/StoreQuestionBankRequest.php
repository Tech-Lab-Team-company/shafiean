<?php

namespace App\Http\Requests\Organization\QuestionBank;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionBankRequest extends ApiRequest
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
            'curriculum_id' => 'nullable|integer|exists:curriculums,id',
            'season_id' => 'nullable|integer|exists:seasons,id',
            'question' => 'required|string|max:191',
            'type' => 'required|string|max:191',
            'degree' => 'required|numeric|min:0|max:10',
        ];
    }
}
