<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Global\AccountSettingsService;
use App\Services\Teacher\Attendance\TeacherOfflineAttendanceService;
use App\Http\Requests\Teacher\AccountSettings\TeacherAccountSettingsRequest;
use App\Http\Requests\Teacher\AccountSettings\TeacherAccountSettingsPasswordRequest;

class TeacherOfflineAttendanceController extends Controller
{
    protected $user;
    public function __construct(protected TeacherOfflineAttendanceService $teacherOfflineAttendanceService)
    {
        $this->user = Auth::guard('organization')->user();
    }
    public function store()
    {
        return $this->teacherOfflineAttendanceService->store()->response();
    }
}
