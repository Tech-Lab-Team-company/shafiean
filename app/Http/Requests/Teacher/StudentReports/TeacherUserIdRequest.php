<?php

namespace App\Http\Requests\Teacher\StudentReports;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherUserIdRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }
}
