<?php

namespace App\Http\Requests\Teacher\StudentReports;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherExamResultIdRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'exam_result_id' => 'required|exists:exam_results,id',
        ];
    }
}
