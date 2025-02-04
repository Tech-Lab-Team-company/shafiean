<?php

namespace App\Services\Teacher\Group;

use Exception;
use App\Models\Group;
use App\Models\Teacher;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Http\Resources\Teacher\Group\TeacherGroupExamResource;
use App\Http\Resources\Teacher\Session\TeacherSessionResource;
use App\Http\Resources\Teacher\Group\TeacherGroupTitleResource;
use App\Http\Resources\Teacher\Group\TeacherGroupStudentResource;
use App\Http\Resources\Teacher\Group\TeacherGroupExamDetailsResource;
use App\Http\Resources\Teacher\Group\TeacherGroupLastSessionResource;

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
            // $exams = Group::find($dataRequest->group_id)->exams()->distinct()->get();
            $query = Group::find($dataRequest->group_id)->exams()->distinct();
            $query->when($dataRequest->word, function ($q) use ($dataRequest) {
                $q->where('name', 'like', '%' . $dataRequest->word . '%');
            });
            $exams = $query->get();
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
    public function teacherGroupExamDetails($dataRequest)
    {
        try {
            $exam = Exam::find($dataRequest->exam_id);
            return new DataSuccess(
                data: new TeacherGroupExamDetailsResource($exam),
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
    public function teacherExams()
    {
        try {
            /** @var Teacher $teacher  */
            $teacher = Auth::guard('organization')->user();
            $exams = $teacher->sessions()
                ->with('group.exams')
                ->get()
                ->pluck('group.exams')
                ->flatten()
                ->unique();
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

    public function teacherGroupLastSessions($dataRequest)
    {
        try {
            $sessions = Group::find($dataRequest->group_id)->groupStageSessions()->orderBy('created_at', 'desc')->take(3)->get();
            return new DataSuccess(
                data: TeacherGroupLastSessionResource::collection($sessions),
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
