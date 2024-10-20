<?php

namespace App\Http\Controllers\User\ExamResultAnswer;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\ExamResultAnswer\ExamResultAnswerService;
use App\Http\Requests\User\ExamResultAnswer\FetchExamResultAnswerRequest;
use App\Http\Requests\User\ExamResultAnswer\StoreExamResultAnswerRequest;

class ExamResultAnswerController extends Controller
{
    public function __construct(protected ExamResultAnswerService $examResultAnswerService) {}


    public function fetchExamResultAnswers(FetchExamResultAnswerRequest $request){

        return $this->examResultAnswerService->fetchExamResultAnswers($request)->response();
    }
    public function store(StoreExamResultAnswerRequest $request)
    {
        return $this->examResultAnswerService->store($request)->response();
    }
}
