<?php

namespace App\Services\Organization\EndPoint\QuestionBank;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\QuestionBank\QuestionBankResource;
use App\Http\Resources\Organization\EndPoint\QuestionBank\FetchQuestionBankResource;

class FetchQuestionBankService
{
    public function fetchQuestionBanks()
    {
        try {
            $questions = Question::where('is_private', 0)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: FetchQuestionBankResource::collection($questions),
                status: true,
                message: 'Fetch Questions Bank fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
