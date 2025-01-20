<?php

namespace App\Http\Controllers\Organization\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Exam\GroupExamService;
use App\Services\Organization\Exam\GroupExamUserService;
use App\Http\Requests\Organization\Exam\GroupExam\FetchGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\StoreGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\DeleteGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\UpdateGroupExamRequest;
use App\Http\Requests\Organization\Exam\GroupExam\FetchGroupExamDetailsRequest;
use App\Http\Requests\Organization\Exam\GroupExamUser\FetchGroupExamUserRequest;

class GroupExamUserController extends Controller
{
    public function __construct(protected  GroupExamUserService $groupExamUserService) {}
    public function index(FetchGroupExamUserRequest $request)
    {
        return $this->groupExamUserService->index($request)->response();
    }
    public function show(FetchGroupExamDetailsRequest $request)
    {
        return $this->groupExamUserService->show($request)->response();
    }
}
