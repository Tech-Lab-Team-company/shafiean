<?php

namespace App\Http\Resources\User\Report;

use Carbon\Carbon;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceAndDepartureReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $user = Auth::guard('user')->user();
        $userSessions = UserSession::where('user_id', $user->id)->where('session_id', $this->id)->first();
        return [
            'id' => $this->id ?? 0,
            'title' => $this->session->title ?? "",
            'teacher_name' => $this->group->teacher->name ?? "",
            'date' => $this->start_date ?? "",
            'from' => Carbon::parse($userSessions->from ?? "")->format('Y-m-d') ?? "",
            'to' => Carbon::parse($userSessions->to ?? "")->format('Y-m-d') ?? "",
            'is_attendance' => $userSessions ? 1 : 0
        ];
    }
}
