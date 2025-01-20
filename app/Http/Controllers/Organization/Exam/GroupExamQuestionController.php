<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\ExamQuestion\GroupExamQuestionService;
use App\Http\Requests\Organization\Exam\ExamQuestion\UpdateExamQuestionRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\FetchGroupExamQuestionRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\StoreGroupExamQuestionRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\DeleteGroupExamQuestionRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\UpdateGroupExamQuestionRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\FetchGroupExamQuestionDetailsRequest;
use App\Http\Requests\Organization\Exam\GroupExamQuestion\UpdateGroupExamQuestionAnswerRequest;

class GroupExamQuestionController extends Controller
{
    public function __construct(protected  GroupExamQuestionService $groupExamQuestionService) {}
    public function index(FetchGroupExamQuestionRequest $request)
    {
        return $this->groupExamQuestionService->index($request)->response();
    }
    public function show(FetchGroupExamQuestionDetailsRequest $request)
    {
        return $this->groupExamQuestionService->show($request)->response();
    }
    public function store(StoreGroupExamQuestionRequest $request)
    {
        return $this->groupExamQuestionService->store($request)->response();
    }
    public function updateQuestion(UpdateGroupExamQuestionRequest $request)
    {
        return $this->groupExamQuestionService->updateQuestion($request)->response();
    }
    public function updateAnswer(UpdateGroupExamQuestionAnswerRequest $request)
    {
        return $this->groupExamQuestionService->updateAnswer($request)->response();
    }
    public function delete(DeleteGroupExamQuestionRequest $request)
    {
        return $this->groupExamQuestionService->delete($request)->response();
    }
}
