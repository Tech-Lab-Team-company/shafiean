<?php

namespace App\Http\Controllers\User\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\Exam\FetchUserExamQuestionRequest;
use App\Services\User\EndPoint\Exam\FetchUserExamQuestionService;

class FetchUserExamQuestionController extends Controller
{
    public function __construct(protected FetchUserExamQuestionService $fetchUserExamQuestionService) {}
    public function __invoke(FetchUserExamQuestionRequest $request)
    {
        return $this->fetchUserExamQuestionService->fetchUserExamQuestion($request)->response();
    }
}
