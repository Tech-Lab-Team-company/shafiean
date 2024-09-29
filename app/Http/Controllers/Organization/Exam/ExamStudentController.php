<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\ExamStudent\ExamStudentService;
use App\Http\Requests\Organization\ExamStudent\StoreExamStudentRequest;
use App\Http\Requests\Organization\ExamStudent\DeleteExamStudentRequest;
use App\Http\Requests\Organization\ExamStudent\UpdateExamStudentRequest;
use App\Http\Requests\Organization\ExamStudent\FetchExamStudentDetailsRequest;

class ExamStudentController extends Controller
{
    public function __construct(protected  ExamStudentService $examStudentService) {}
    public function index()
    {
        return $this->examStudentService->index()->response();
    }
    public function show(FetchExamStudentDetailsRequest $request)
    {
        return $this->examStudentService->show($request)->response();
    }
    public function store(StoreExamStudentRequest $request)
    {
        return $this->examStudentService->store($request->validated())->response();
    }
    public function update(UpdateExamStudentRequest $request)
    {
        return $this->examStudentService->update($request->validated())->response();
    }
    public function delete(DeleteExamStudentRequest $request)
    {
        return $this->examStudentService->delete($request)->response();
    }
}
