<?php

namespace App\Http\Controllers\User\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\Exam\FetchUserExamResultRequest;
use App\Services\User\EndPoint\Exam\FetchUserExamResultService;

class FetchUserExamResultController extends Controller
{
    public function __construct(protected FetchUserExamResultService $fetchUserExamResultService) {}
    public function __invoke(FetchUserExamResultRequest $request)
    {
        return $this->fetchUserExamResultService->fetchUserExamResult($request)->response();
    }
}
