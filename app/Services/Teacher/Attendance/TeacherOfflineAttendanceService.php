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
    public function index($auth)
    {
        try {
            $userSessions = UserSession::whereTeacherId($auth->id)->paginate(15);
            return new DataSuccess(
                data: TeacherOfflineAttendanceResource::collection($userSessions),
                status: true,
                message: __('messages.success')
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function show($request)
    {
        try {
            $userSession = UserSession::find($request->id);
            return new DataSuccess(
                data: new TeacherOfflineAttendanceResource($userSession),
                status: true,
                message: __('messages.success')
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function store($dataRequest, $auth)
    {
        try {
            $session = GroupStageSession::find($dataRequest->session_id);
            $live = $session->lives()->latest()->first();
            $liveId = $live->id ?? null;
            $from = Carbon::createFromFormat('d-m-Y', $dataRequest->from)->format('Y-m-d ' . $dataRequest->from_time);
            $to = Carbon::createFromFormat('d-m-Y', $dataRequest->to)->format('Y-m-d ' . $dataRequest->to_time);
            $userSession = UserSession::create([
                'teacher_id' => $auth->id,
                'user_id' => $dataRequest->user_id,
                'group_id' => $dataRequest->group_id,
                'session_id' => $dataRequest->session_id,
                'live_id' => $liveId ?? null,
                'from' => $from,
                'to' => $to
            ]);
            return new DataSuccess(
                data: new TeacherOfflineAttendanceResource($userSession),
                status: true,
                message: __('messages.success_create')
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function update($dataRequest, $auth)
    {
        try {
            $userSession = UserSession::find($dataRequest->id);
            if (!$userSession) {
                return new DataFailed(
                    status: false,
                    message: __('messages.not_found')
                );
            }
            $from = Carbon::createFromFormat('d-m-Y', $dataRequest->from)->format('Y-m-d ' . $dataRequest->from_time);
            $to = Carbon::createFromFormat('d-m-Y', $dataRequest->to)->format('Y-m-d ' . $dataRequest->to_time);
            $userSession->update([
                'user_id' => $dataRequest->user_id,
                'group_id' => $dataRequest->group_id,
                'session_id' => $dataRequest->session_id,
                'from' => $from,
                'to' => $to
            ]);
            return new DataSuccess(
                data: new TeacherOfflineAttendanceResource($userSession),
                status: true,
                message: __('messages.success_update')
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function delete($dataRequest)
    {
        try {
            $userSession = UserSession::find($dataRequest->id);
            if (!$userSession) {
                return new DataFailed(
                    status: false,
                    message: __('messages.not_found')
                );
            }
            $userSession->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_delete')
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
