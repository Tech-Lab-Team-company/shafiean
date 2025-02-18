<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Global\AccountSettingsService;
use App\Http\Requests\Group\FetchGroupStudentRequest;
use App\Http\Requests\Teacher\Group\TeacherGroupIdRequest;
use App\Services\Teacher\Attendance\TeacherOfflineAttendanceService;
use App\Services\Organization\EndPoint\Group\FetchGroupStudentService;
use App\Http\Requests\Teacher\Attendance\TeacherEditOfflineAttendanceRequest;
use App\Http\Requests\Teacher\Attendance\TeacherStoreOfflineAttendanceRequest;
use App\Http\Requests\Teacher\Attendance\TeacherDeleteOfflineAttendanceRequest;
use App\Http\Requests\Teacher\Attendance\TeacherOfflineAttendanceDetailsRequest;

class TeacherOfflineAttendanceController extends Controller
{
    protected $auth;
    public function __construct(protected TeacherOfflineAttendanceService $teacherOfflineAttendanceService,protected FetchGroupStudentService $fetchGroupStudentService)
    {
        $this->auth = Auth::guard('organization')->user();
    }
    public function index(Request $request)
    {
        return $this->teacherOfflineAttendanceService->index($this->auth)->response();
    }
    public function show(TeacherOfflineAttendanceDetailsRequest $request)
    {
        return $this->teacherOfflineAttendanceService->show($request)->response();
    }
    public function store(TeacherStoreOfflineAttendanceRequest $request)
    {
        return $this->teacherOfflineAttendanceService->store($request, $this->auth)->response();
    }
    public function update(TeacherEditOfflineAttendanceRequest $request)
    {
        return $this->teacherOfflineAttendanceService->update($request, $this->auth)->response();
    }
    public function delete(TeacherDeleteOfflineAttendanceRequest $request)
    {
        return $this->teacherOfflineAttendanceService->delete($request)->response();
    }
    public function subscriptionUserForAttendance(FetchGroupStudentRequest $request)
    {
        return $this->fetchGroupStudentService->fetchGroupStudent($request)->response();
    }
}
