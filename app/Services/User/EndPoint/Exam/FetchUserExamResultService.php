<?php

namespace App\Services\User\EndPoint\Exam;


use App\Enum\ExamResultStatusEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamResult;
use App\Http\Resources\User\ExamResult\FetchExamResultResource;

class FetchUserExamResultService
{
    public function fetchUserExamResult($dataRequest): DataStatus
    {
        try {
            $userId = auth('user')->user()->id;
            $examResult = ExamResult::whereExamId($dataRequest["exam_id"])
                ->whereUserId($userId)
                ->whereStatus(ExamResultStatusEnum::ACTIVE->value)
                ->first();
            if (!$examResult) {
                return new DataFailed(
                    status: false,
                    message: 'Exam Result not found for user'
                );
            }
            return new DataSuccess(
                status: true,
                message: 'Exam Result retrieved successfully',
                data: new FetchExamResultResource($examResult),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function fetchUserExamResults(): DataStatus
    {
        try {
            $userId = auth('user')->user()->id;
            $examResult = ExamResult::whereUserId($userId)
                ->whereStatus(ExamResultStatusEnum::ACTIVE->value)
                ->get();
                if (!$examResult) {
                    return new DataFailed(
                        status: false,
                        message: 'Exam Result not found for user'
                    );
                }
            return new DataSuccess(
                status: true,
                message: 'Exam Results retrieved successfully',
                data:  FetchExamResultResource::collection($examResult),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
