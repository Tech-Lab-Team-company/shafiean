<?php

namespace App\Services\Teacher\Group;

use Exception;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Teacher\Group\TeacherGroupExamResource;
use App\Http\Resources\Teacher\Session\TeacherSessionResource;
use App\Http\Resources\Teacher\Group\TeacherGroupTitleResource;
use App\Http\Resources\Teacher\Group\TeacherGroupStudentResource;

class TeacherGroupService
{

    public function teacherGroup()
    {
        try {
            /** @var Teacher $teacher  */
            $teacher = Auth::guard('organization')->user();
            $groups = Group::whereHas('groupStageSessions', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            })->distinct()->get();
            return new DataSuccess(
                data: TeacherGroupTitleResource::collection($groups),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupSessions($dataRequest)
    {
        try {
            $sessions = Group::find($dataRequest->group_id)->groupStageSessions()->get();
            return new DataSuccess(
                data: TeacherSessionResource::collection($sessions),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupStudents($dataRequest)
    {
        try {
            $students = Group::find($dataRequest->group_id)->users()->distinct()->get();
            return new DataSuccess(
                data: TeacherGroupStudentResource::collection($students),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupExams($dataRequest)
    {
        try {
            $exams = Group::find($dataRequest->group_id)->exams()->distinct()->get();
            return new DataSuccess(
                data: TeacherGroupExamResource::collection($exams),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
