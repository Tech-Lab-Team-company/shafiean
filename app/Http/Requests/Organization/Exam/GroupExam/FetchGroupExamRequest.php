<?php

namespace App\Http\Requests\Organization\Exam\GroupExam;

use App\Helpers\Response\ApiRequest;

class FetchGroupExamRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'group_id' => 'required|exists:groups,id',
            'word' => 'nullable|string',
        ];
    }
}
