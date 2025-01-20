<?php
namespace App\Http\Requests\Organization\Exam\GroupExamUser;


use App\Helpers\Response\ApiRequest;

class FetchGroupExamUserRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'exam_id' => 'required|exists:exams,id',
        ];
    }
}
