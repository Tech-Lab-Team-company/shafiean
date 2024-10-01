<?php

namespace App\Http\Controllers\Organization\QuestionBank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\QuestionBank\FetchQuestionBankService;

class FetchQuestionBankContoller extends Controller
{
    public function __construct(protected FetchQuestionBankService $fetchQuestionBankService) {}
    public function __invoke()
    {
        return $this->fetchQuestionBankService->fetchQuestionBanks()->response();

    }
}
