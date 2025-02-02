<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Teacher\Group\TeacherGroupService;
use App\Http\Requests\Teacher\Group\TeacherGroupIdRequest;
use App\Http\Requests\Teacher\Group\TeacherGroupExamIdRequest;

class TeacherGroupController extends Controller
{
    public function __construct(protected TeacherGroupService $teacherGroupService) {}

    public function teacherGroup()
    {
        return $this->teacherGroupService->teacherGroup()->response();
    }
    public function teacherGroupSessions(TeacherGroupIdRequest $request)
    {
        return $this->teacherGroupService->teacherGroupSessions($request)->response();
    }
    public function teacherGroupStudents(TeacherGroupIdRequest $request)
    {
        return $this->teacherGroupService->teacherGroupStudents($request)->response();
    }
    public function teacherGroupExams(TeacherGroupIdRequest $request)
    {
        return $this->teacherGroupService->teacherGroupExams($request)->response();
    }
    public function teacherGroupExamDetails(TeacherGroupExamIdRequest $request)
    {
        return $this->teacherGroupService->teacherGroupExamDetails($request)->response();
    }
    public function teacherExams()
    {
        return $this->teacherGroupService->teacherExams()->response();
    }
    public function teacherGroupLastSessions(TeacherGroupIdRequest $request)
    {
        return $this->teacherGroupService->teacherGroupLastSessions($request)->response();
    }
}
