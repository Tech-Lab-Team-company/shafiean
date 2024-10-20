<?php

namespace App\Services\User\EndPoint\Exam;


use App\Models\Group;
use App\Models\Subscription;
use App\Enum\ExamResultStatusEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\GroupResource;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamResult;
use App\Models\Organization\Exam\ExamQuestion;
use App\Http\Resources\User\Exam\FetchUserExamQuestionResource;
use App\Http\Resources\User\EndPoint\Group\FetchUserSubscriptionGroupResource;

class FetchUserExamQuestionService
{
    public function fetchUserExamQuestion($dataRequest): DataStatus
    {
        try {
            $exam = Exam::whereId($dataRequest["exam_id"])->first();
            $user = auth('user')->user();
            ExamResult::create([
                'exam_id' => $dataRequest["exam_id"],
                'user_id' => $user->id,
                'grade' => 1,
                'status' => ExamResultStatusEnum::ACTIVE->value
            ]);
            return new DataSuccess(
                status: true,
                message: 'Exam Questions retrieved successfully',
                data: new FetchUserExamQuestionResource($exam),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
