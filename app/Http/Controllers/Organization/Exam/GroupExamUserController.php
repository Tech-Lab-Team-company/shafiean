<?php

namespace App\Http\Controllers\Organization\Exam;

use App\Http\Controllers\Controller;
use App\Services\Organization\Exam\GroupExamUserService;
use App\Http\Requests\Organization\Exam\GroupExamUser\FetchGroupExamUserRequest;
use App\Http\Requests\Organization\Exam\GroupExam\FetchGroupExamUserDetailsRequest;

class GroupExamUserController extends Controller
{
    public function __construct(protected  GroupExamUserService $groupExamUserService) {}
    public function index(FetchGroupExamUserRequest $request)
    {
        return $this->groupExamUserService->index($request)->response();
    }
    public function show(FetchGroupExamUserDetailsRequest $request)
    {
        return $this->groupExamUserService->show($request)->response();
    }
}
