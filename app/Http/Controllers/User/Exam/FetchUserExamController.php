<?php

namespace App\Http\Controllers\User\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Exam\FetchUserExamRequest;
use App\Services\User\EndPoint\Exam\FetchUserExamService;

class FetchUserExamController extends Controller
{
    public function __construct(protected FetchUserExamService $fetchUserExamService) {}
    public function __invoke(FetchUserExamRequest $request)
    {
        return $this->fetchUserExamService->fetchUserExam($request)->response();
    }
}
