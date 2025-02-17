<?php

namespace App\Http\Requests\Teacher\Attendance;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherEditOfflineAttendanceRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:user_sessions,id',
            'user_id' => 'required|exists:users,id',
            'group_id' => 'required|exists:groups,id',
            'session_id' => 'required|exists:group_stage_sessions,id',
            // 'live_id' => 'required|exists:lives,id',
            'from' => 'required|date',
            'to' => 'required|date',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i',
        ];
    }
}
