<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\ExamQuestion\GroupExamQuestionService;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\StoreGroupExamQuestionRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\DeleteGroupExamQuestionRequest;

class GroupExamQuestionController extends Controller
{
    public function __construct(protected  GroupExamQuestionService $groupExamQuestionService) {}
    // public function index()
    // {
    //     return $this->groupExamQuestionService->index()->response();
    // }
    // public function show(FetchExamQuestionDetailsRequest $request)
    // {
    //     return $this->groupExamQuestionService->show($request)->response();
    // }
    public function store(StoreGroupExamQuestionRequest $request)
    {
        return $this->groupExamQuestionService->store($request)->response();
    }
    // public function update(UpdateExamQuestionRequest $request)
    // {
    //     return $this->groupExamQuestionService->update($request->validated())->response();
    // }
    public function delete(DeleteGroupExamQuestionRequest $request)
    {
        return $this->groupExamQuestionService->delete($request)->response();
    }
}
