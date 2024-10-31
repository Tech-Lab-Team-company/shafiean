<?php

namespace App\Http\Controllers\Organization\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Attendance\AttendanceService;
use App\Http\Requests\Organization\Attendance\AttendanceRequest;
use App\Http\Requests\Organization\Attendance\FetchAttendanceRequest;
use App\Http\Requests\Organization\Attendance\LeaveRequest;

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
    public function fetch_attendance(FetchAttendanceRequest $request)
    {
        return $this->attendance_service->fetch_attendance($request)->response();
    }
    public function leave(LeaveRequest $request)
    {
        return $this->attendance_service->leave($request)->response();
    }
}
