<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Exam\GroupExamService;
use App\Http\Requests\Organization\Exam\GroupExam\FetchGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\StoreGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\DeleteGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\UpdateGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExamUser\FetchGroupExamDetailsRequest;

class GroupExamController extends Controller
{
    public function __construct(protected  GroupExamService $groupExamService) {}
    public function index(FetchGroupExamRequest $request)
    {
        return $this->groupExamService->index($request)->response();
    }
    public function show(FetchGroupExamDetailsRequest $request)
    {
        return $this->groupExamService->show($request)->response();
    }
    public function store(StoreGroupExamRequest $request)
    {
        return $this->groupExamService->store($request)->response();
    }
    public function update(UpdateGroupExamRequest $request)
    {
        return $this->groupExamService->update($request)->response();
    }
    public function delete(DeleteGroupExamRequest $request)
    {
        return $this->groupExamService->delete($request)->response();
    }
}
