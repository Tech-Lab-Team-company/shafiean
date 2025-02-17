<?php

namespace App\Services\Teacher\Attendance;

use Carbon\Carbon;
use App\Models\UserSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Enum\UserSessionAttendanEnum;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Teacher\Attendance\TeacherOfflineAttendanceResource;

class TeacherOfflineAttendanceService
{
    public function index()
    {
        try {
            $session = GroupStageSession::find($dataRequest->session_id);
            $live = $session->lives()->latest()->first();
            $liveId = $live->id ?? null;
            $from = Carbon::createFromFormat('d-m-Y', $dataRequest->from)->format('Y-m-d ' . $dataRequest->from_time);
            $to = Carbon::createFromFormat('d-m-Y', $dataRequest->to)->format('Y-m-d ' . $dataRequest->to_time);
            $userSession = UserSession::create([
                'user_id' => $dataRequest->user_id,
                'group_id' => $dataRequest->group_id,
                'session_id' => $dataRequest->session_id,
                'live_id' => $liveId ?? null,
                'from' => $from,
                'to' => $to
                // 'is_attendan' => UserSessionAttendanEnum::ATTENDAN->value
            ]);

            return new DataSuccess(
                data: new TeacherOfflineAttendanceResource($userSession),
                status: true,
                message: 'Attendance marked successfully'
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function store($dataRequest)
    {
        try {
            $session = GroupStageSession::find($dataRequest->session_id);
            $live = $session->lives()->latest()->first();
            $liveId = $live->id ?? null;
            $from = Carbon::createFromFormat('d-m-Y', $dataRequest->from)->format('Y-m-d ' . $dataRequest->from_time);
            $to = Carbon::createFromFormat('d-m-Y', $dataRequest->to)->format('Y-m-d ' . $dataRequest->to_time);
            $userSession = UserSession::create([
                'user_id' => $dataRequest->user_id,
                'group_id' => $dataRequest->group_id,
                'session_id' => $dataRequest->session_id,
                'live_id' => $liveId ?? null,
                'from' => $from,
                'to' => $to
                // 'is_attendan' => UserSessionAttendanEnum::ATTENDAN->value
            ]);

            return new DataSuccess(
                data: new TeacherOfflineAttendanceResource($userSession),
                status: true,
                message: 'Attendance marked successfully'
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
