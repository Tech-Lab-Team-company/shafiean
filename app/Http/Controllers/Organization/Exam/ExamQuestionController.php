<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\ExamQuestion\ExamQuestionService;
use App\Http\Requests\Organization\Exam\ExamQuestion\StoreExamQuestionRequest;
use App\Http\Requests\Organization\Exam\ExamQuestion\DeleteExamQuestionRequest;
use App\Http\Requests\Organization\Exam\ExamQuestion\UpdateExamQuestionRequest;
use App\Http\Requests\Organization\Exam\ExamQuestion\FetchExamQuestionDetailsRequest;

class ExamQuestionController extends Controller
{
    public function __construct(protected  ExamQuestionService $examQuestionService) {}
    public function index()
    {
        return $this->examQuestionService->index()->response();
    }
    public function show(FetchExamQuestionDetailsRequest $request)
    {
        return $this->examQuestionService->show($request)->response();
    }
    public function store(StoreExamQuestionRequest $request)
    {
        return $this->examQuestionService->store($request->validated())->response();
    }
    public function update(UpdateExamQuestionRequest $request)
    {
        return $this->examQuestionService->update($request->validated())->response();
    }
    public function delete(DeleteExamQuestionRequest $request)
    {
        return $this->examQuestionService->delete($request)->response();
    }
}
