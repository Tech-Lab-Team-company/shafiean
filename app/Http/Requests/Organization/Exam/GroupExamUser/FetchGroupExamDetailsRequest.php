<?php

namespace App\Http\Requests\Organization\Exam\GroupExam;

use App\Helpers\Response\ApiRequest;

class FetchGroupExamDetailsRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'id' => 'required|exists:exams,id',
        ];
    }
}
