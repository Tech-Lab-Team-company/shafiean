<?php

namespace App\Http\Requests\Teacher\Group;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherOfflineAttendanceRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'group_id' => 'required|exists:groups,id',
            'session_id' => 'required|exists:group_stage_sessions,id',
        ];
    }
}
