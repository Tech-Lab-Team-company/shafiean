<?php


namespace App\Services\Parent;

use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Parent\Child\ChildResource;
use App\Http\Resources\Parent\Exam\FetchChildExamResource;
use App\Http\Resources\Parent\Child\ChildAttendanceResource;
use App\Http\Resources\Parent\Session\ChildSessionAttendanceResource;

class ChildService
{
    public function academic_report($request): DataStatus
    {
        try {
            $parent = auth()->guard('user')->user();
            $children = $parent->childs;
            // dd($children);
            return new DataSuccess(
                data: ChildResource::collection($children),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function exam_report($request): DataStatus
    {
        try {
            $parent = auth()->guard('user')->user();
            if (isset($request->student_id)) {
                $children = $parent->childs()->where('users.id', $request->student_id)->get();
            } else {
                $children = $parent->childs;
            }
            // dd($children);
            return new DataSuccess(
                data: FetchChildExamResource::collection($children),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function session_attendance_report($request): DataStatus
    {
        try {
            $parent = auth()->guard('user')->user();
            $children = $parent->childs;
            // dd($children);
            $groups = $children->map(function ($child) {
                return  $child->subscripe_groups()->pluck('group_id')->toArray();
            })->flatten();
            $sessions = GroupStageSession::whereIn('group_id', $groups)->get();
            // dd($sessions);
            // dd($children);
            return new DataSuccess(
                // data: ChildAttendanceResource::collection($children),
                data: ChildSessionAttendanceResource::collection($sessions),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
