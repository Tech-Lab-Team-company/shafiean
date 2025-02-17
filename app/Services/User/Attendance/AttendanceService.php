<?php

namespace App\Services\User\Attendance;


use App\Models\User;
use App\Models\UserSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Enum\UserSessionAttendanEnum;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\User\Attendance\AttendanceResource;

class AttendanceService
{

    public function attendance($request): DataStatus
    {
        try {
            $session = GroupStageSession::find($request->session_id);
            // dd($session);
            $live = $session->lives()->latest()->first();
            // dd($live);
            if ($live == null) {
                return new DataFailed(
                    status: false,
                    message: __('messages.live_not_found')
                );
            }
            $userId = auth()->guard('user')->user()->id;
            $groupId = $session->group->id;
            $sessionId = $request->session_id;
            $liveId = $live->id;
            $user_session = UserSession::updateOrCreate([
                'user_id' => $userId,
                'group_id' => $groupId,
                'session_id' => $sessionId,
                'live_id' => $live->id
            ], [
                'user_id' => $userId,
                'group_id' => $groupId,
                'session_id' => $sessionId,
                'live_id' => $liveId,
                'from' => now(),
                'is_attendan' => UserSessionAttendanEnum::ATTENDAN->value
            ]);
            return new DataSuccess(
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
    public function fetch_attendance($request): DataStatus
    {
        try {
            $query = UserSession::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->parentStudentAttendance($query, $request);
            }

            $user_sessions = $query->orderBy('id', 'desc')->get();
            return new DataSuccess(
                status: true,
                data: AttendanceResource::collection($user_sessions),
                message: 'Attendance marked successfully'
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function leave($request): DataStatus
    {
        try {
            $user_session = UserSession::where('user_id', auth()->guard('user')->user()->id)->where('session_id', $request->session_id)->first();
            if ($user_session == null) {
                return new DataFailed(
                    status: false,
                    message: __('messages.live_not_found')
                );
            }
            $user_session->update([
                'to' => now(),
                'is_attendan' => UserSessionAttendanEnum::NOT_ATTENDAN->value
            ]);
            return new DataSuccess(
                status: true,
                message: __('messages.leave_live')
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
