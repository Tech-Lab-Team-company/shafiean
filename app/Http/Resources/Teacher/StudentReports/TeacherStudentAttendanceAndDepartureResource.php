<?php

namespace App\Http\Resources\Teacher\StudentReports;

use Carbon\Carbon;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherStudentAttendanceAndDepartureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userSessions = UserSession::where('user_id', $request->user_id)->where('session_id', $this->id)->first();
        return [
            'id' => $this->id ?? 0,
            'title' => $this->session_id ? $this->session->title : $this->title,
            'date' => $this->date ?? "",
            'start_time' => $this->start_time ?? 0,
            'end_time' => $this->end_time ?? 0,
            'is_attendance' => $userSessions ? 1 : 0
        ];
    }
}
