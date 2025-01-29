<?php

namespace App\Http\Controllers\Teacher;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Teacher\Group\TeacherGroupService;
use App\Services\Teacher\Session\TeacherSessionService;

class TeacherGroupController extends Controller
{
    public function __construct(protected TeacherGroupService $teacherGroupService) {}

    public function teacherGroup()
    {
        return $this->teacherGroupService->teacherGroup()->response();
    }
}
