<?php

namespace App\Services\Organization\Landingpage\EndPoint\CommonQuestion;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\Blog;
use App\Models\Organization\Competition\Competition;
use App\Models\Organization\Landingpage\CommonQuestion;
use App\Http\Resources\Organization\Landingpage\EndPoint\Blog\FetchBlogResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\Competition\FetchCompetitionResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\CommonQuestion\FetchCommonQuestionResource;

class FetchCommonQuestionService
{
    public function fetchCommonQuestions()
    {
        try {
            $commonQuestions  = CommonQuestion::get();
            return new DataSuccess(
                data: FetchCommonQuestionResource::collection($commonQuestions),
                status: true,
                message: 'Fetch Common Question successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
