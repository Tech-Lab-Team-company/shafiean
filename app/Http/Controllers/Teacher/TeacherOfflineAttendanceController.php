<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Global\AccountSettingsService;
use App\Services\Teacher\Attendance\TeacherOfflineAttendanceService;
use App\Http\Requests\Teacher\Attendance\TeacherOfflineAttendanceRequest;

class TeacherOfflineAttendanceController extends Controller
{
    protected $user;
    public function __construct(protected TeacherOfflineAttendanceService $teacherOfflineAttendanceService)
    {
        $this->user = Auth::guard('organization')->user();
    }
    public function index(Request $request)
    {
        return $this->teacherOfflineAttendanceService->index()->response();
    }
    public function store(TeacherOfflineAttendanceRequest $request)
    {
        return $this->teacherOfflineAttendanceService->store($request)->response();
    }
}
