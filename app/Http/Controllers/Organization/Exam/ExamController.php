<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Exam\ExamService;
use App\Http\Requests\Organization\Exam\Exam\StoreExamRequest;
use App\Http\Requests\Organization\Exam\Exam\DeleteExamRequest;
use App\Http\Requests\Organization\Exam\Exam\UpdateExamRequest;
use App\Http\Requests\Organization\Exam\Exam\FetchExamDetailsRequest;

class ExamController extends Controller
{
    public function __construct(protected  ExamService $examService) {}
    public function index()
    {
        return $this->examService->index()->response();
    }
    public function show(FetchExamDetailsRequest $request)
    {
        return $this->examService->show($request)->response();
    }
    public function store(StoreExamRequest $request)
    {
        return $this->examService->store($request)->response();
    }
    public function update(UpdateExamRequest $request)
    {
        return $this->examService->update($request)->response();
    }
    public function delete(DeleteExamRequest $request)
    {
        return $this->examService->delete($request)->response();
    }
}
