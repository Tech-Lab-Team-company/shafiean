<?php

namespace App\Http\Controllers\Teacher;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Teacher\Group\TeacherGroupService;
use App\Services\Teacher\Session\TeacherSessionService;
use App\Http\Requests\Teacher\Group\TeacherSessionByGroupRequest;

class TeacherGroupController extends Controller
{
    public function __construct(protected TeacherGroupService $teacherGroupService) {}

    public function teacherGroup()
    {
        return $this->teacherGroupService->teacherGroup()->response();
    }
    public function teacherGroupSession(TeacherSessionByGroupRequest $request)
    {
        return $this->teacherGroupService->teacherGroupSession($request)->response();
    }
}
