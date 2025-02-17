<?php

namespace App\Http\Requests\Teacher\Attendance;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherDeleteOfflineAttendanceRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:user_sessions,id',
        ];
    }
}
