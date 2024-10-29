<?php

namespace App\Services\Organization\ExamResult;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Services\Global\FilterService;
use App\Models\Organization\Exam\ExamResult;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Models\Organization\Exam\ExamResultAnswer;
use App\Http\Resources\Organization\Exam\ExamResource;
use App\Http\Resources\User\ExamResult\FetchExamResultResource;
use App\Http\Resources\Organization\ExamResult\ExamResultResource;
use App\Http\Resources\Organization\ExamResult\ExamResultAnswerResource;

class ExamResultService
{
    public function index()
    {
        try {
            $examResults = ExamResult::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: ExamResultResource::collection($examResults)->response()->getData(true),
                status: true,
                message: 'Exam Results fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function show($dataRequest)
    {
        $examResultAnswers = ExamResult::whereId($dataRequest->exam_result_id)->first();

        return new DataSuccess(
            data: new ExamResultAnswerResource($examResultAnswers),
            statusCode: 200,
            message: 'Fetch Exam Result Answer successfully'
        );
    }
}
