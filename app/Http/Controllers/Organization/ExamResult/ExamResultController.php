<?php

namespace App\Http\Controllers\Organization\ExamResult;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\ExamResult\ExamResultService;
use App\Http\Requests\Organization\ExamResultAnswer\ExamResultAnswerRequest;
use App\Http\Requests\Organization\ExamResultAnswer\ShowExamResultAnswerRequest;

class ExamResultController extends Controller
{
    public function __construct(protected ExamResultService $examResultService) {}
    public function index()
    {
        return $this->examResultService->index()->response();
    }
    public function show(ShowExamResultAnswerRequest $request)
    {
        return $this->examResultService->show($request)->response();
    }
}
