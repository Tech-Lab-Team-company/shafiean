<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Services\TeacherService;
use Illuminate\Http\Response;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index()
    {
        $teachers = $this->teacherService->getAllTeachers();
        return TeacherResource::collection($teachers);
    }

    public function store(TeacherRequest $request)
    {
        $teacher = $this->teacherService->createTeacher($request->validated());
        return new TeacherResource($teacher);
    }

    public function show($id)
    {
        $teacher = $this->teacherService->getTeacherById($id);
        return new TeacherResource($teacher);
    }

    public function update(TeacherRequest $request, $id)
    {
        $teacher = $this->teacherService->updateTeacher($id, $request->validated());
        return new TeacherResource($teacher);
    }

    public function destroy($id)
    {
        $this->teacherService->deleteTeacher($id);
        return response()->json(['message' => 'teacher deleted successfully.'], 200);
    }
}
