<?php

namespace App\Services\User\ExamResultAnswer;



use Exception;
use App\Enum\ExamResultStatusEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamResult;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Models\Organization\Exam\ExamResultAnswer;
use App\Http\Resources\Organization\Exam\ExamResource;
use App\Http\Resources\User\ExamResultAnswer\UserExamResultAnswerResource;

class ExamResultAnswerService
{
    // public function index()
    // {
    //     try {
    //         $exams = Exam::orderBy('id', 'desc')->paginate(10);
    //         return new DataSuccess(
    //             data: ExamResource::collection($exams)->response()->getData(true),
    //             status: true,
    //             message: 'Exams fetched successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }

    public function store(object $dataRequest): DataStatus
    {
        try {
            $userId = auth('user')->user()->id;
            $examResult = ExamResult::whereExamId($dataRequest["exam_id"])
                ->whereUserId($userId)
                ->whereStatus(ExamResultStatusEnum::ACTIVE->value)
                ->first();
            $examResultAnswer = ExamResultAnswer::create([
                'user_id' => auth('user')->user()->id,
                'question_id' => $dataRequest->question_id,
                'answer_id' => $dataRequest->answer_id,
                'exam_result_id' => $examResult->id,
                'grade' => $dataRequest->grade
            ]);

            return new DataSuccess(
                data: new UserExamResultAnswerResource($examResultAnswer),
                status: true,
                message: 'Exam Result Answer created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
