<?php

namespace App\Http\Controllers\User\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Attendance\AttendanceService;
use App\Http\Requests\User\Attendance\AttendanceRequest;
use App\Http\Requests\User\Attendance\FetchStudentAttendanceRequest;


class AttendanceController extends Controller
{
    protected $attendance_service;

    public function __construct(AttendanceService $attendance_service)
    {
        $this->attendance_service = $attendance_service;
    }

    public function attendance(AttendanceRequest $request)
    {
        return $this->attendance_service->attendance($request)->response();
    }
    public function fetch_attendance(FetchStudentAttendanceRequest $request)
    {
        return $this->attendance_service->fetch_attendance($request)->response();
    }
}
