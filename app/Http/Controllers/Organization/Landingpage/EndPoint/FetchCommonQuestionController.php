<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\CommonQuestion\FetchCommonQuestionService;

class FetchCommonQuestionController  extends Controller
{

    public function __construct(protected FetchCommonQuestionService $fetchCommonQuestionService) {}

    public function __invoke()
    {
        return $this->fetchCommonQuestionService->fetchCommonQuestions()->response();
    }
}
