<?php

namespace App\Http\Controllers\Organization\Teacher;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Teacher\TeacherRequest;
use App\Services\Organization\Teacher\TeacherService;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }
    public function index()
    {
        return $this->teacherService->getAllTeachers()->response();
    }
    public function add_employee(TeacherRequest $request)
    {
        return $this->teacherService->createTeacher($request->validated())->response();
    }
    public function show($id)
    {
        return $this->teacherService->getTeacherById($id)->response();
    }
    public function update(TeacherRequest $request, $id)
    {
        return $this->teacherService->updateTeacher($id, $request->validated())->response();
    }
    public function destroy($id)
    {
        return $this->teacherService->deleteTeacher($id)->response();
    }
    public function fetchTeachers()
    {
        $auth = Auth::guard('organization')->user();
        return $this->teacherService->fetchTeachers($auth)->response();
    }
}
