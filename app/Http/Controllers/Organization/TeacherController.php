<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherRequest;
use App\Services\TeacherService;

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

    public function store(TeacherRequest $request)
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
}
