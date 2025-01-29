<?php

namespace App\Http\Controllers\Teacher;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Teacher\Group\TeacherGroupService;
use App\Services\Teacher\Session\TeacherSessionService;
use App\Http\Requests\Teacher\Group\TeacherGroupIdRequest;
use App\Http\Requests\Teacher\Group\TeacherSessionByGroupRequest;

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
}
