<?php

namespace App\Services\Organization\Attendance;

use App\Models\User;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Attendance\AttendanceResource;
use App\Models\UserSession;
use App\Services\Global\FilterService;

class AttendanceService
{

    public function attendance($request): DataStatus
    {
        try {
            $session = GroupStageSession::find($request->session_id);
            $live = $session->lives()->latest()->first();
            // dd($live);
            if ($live == null) {
                return new DataFailed(
                    status: false,
                    message: 'Live not found'
                );
            }
            $live->update([
                'teacher_id' => auth()->guard('organization')->user()->id,
                'join_date' => now(),
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
                $filter_service->filterUsersAttendance($query, $request);
            }
            $user_session = $query->paginate(10);
            return new DataSuccess(
                status: true,
                data: AttendanceResource::collection($user_session)->response()->getData(true),
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
            $session = GroupStageSession::find($request->session_id);
            $live = $session->lives()->where('teacher_id', auth()->guard('organization')->user()->id)->latest()->first();
            if ($live == null) {
                return new DataFailed(
                    status: false,
                    message: 'Live not found'
                );
            }
            $live->update([
                'leave_date' => now(),
            ]);
            return new DataSuccess(
                status: true,
                message: 'leaved  successfully'
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
