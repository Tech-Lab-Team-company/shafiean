<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StudentReports\TeacherUserIdRequest;
use App\Services\Teacher\StudentReports\TeacherStudentReportsService;

class TeacherStudentReportsController extends Controller
{
    public function __construct(protected TeacherStudentReportsService $teacherStudentReportsService) {}

    public function studentAttendanceAndDeparture(TeacherUserIdRequest $request)
    {
        return $this->teacherStudentReportsService->StudentAttendanceAndDeparture($request)->response();
    }
}
