<?php

namespace App\Http\Controllers\Teacher;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Teacher\Session\TeacherSessionService;

class TeacherSessionController extends Controller
{
    public function __construct(protected TeacherSessionService $teacherSessionService) {}

    public function currentSession()
    {
        return $this->teacherSessionService->currentSession()->response();
    }
    public function nextSession()
    {
        return $this->teacherSessionService->nextSession()->response();
    }
    public function finishedSession()
    {
        return $this->teacherSessionService->finishedSession()->response();
    }
}
