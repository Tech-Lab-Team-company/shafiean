<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Teacher\Session\TeacherSessionService;
use App\Services\Teacher\Session\TeacherMainSessionService;
use App\Http\Requests\Teacher\MainSession\TeacherAddSessionRequest;
use App\Http\Requests\Organization\MainSession\DeleteSessionRequest;
use App\Http\Requests\Teacher\MainSession\TeacherEditSessionRequest;
use App\Http\Requests\Organization\MainSession\FetchSessionDetailsRequest;
use App\Http\Requests\Organization\MainSession\MainSessionIndexForGroupRequest;

class TeacherSessionController extends Controller
{
    protected $auth;
    public function __construct(protected TeacherSessionService $teacherSessionService, protected TeacherMainSessionService $teacherMainSessionService)
    {
        $this->auth = Auth::guard('organization')->user();
    }
    public function index(MainSessionIndexForGroupRequest $request)
    {
        return $this->teacherMainSessionService->index($request,  $this->auth)->response();
    }
    public function store(TeacherAddSessionRequest $request)
    {
        return $this->teacherMainSessionService->create($request, $this->auth)->response();
    }
    public function show(FetchSessionDetailsRequest $request)
    {
        return $this->teacherMainSessionService->getDetails($request)->response();
    }
    public function update(TeacherEditSessionRequest $request)
    {
        return $this->teacherMainSessionService->update($request, $this->auth)->response();
    }
    public function destroy(DeleteSessionRequest $request)
    {
        return $this->teacherMainSessionService->delete($request)->response();
    }
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
