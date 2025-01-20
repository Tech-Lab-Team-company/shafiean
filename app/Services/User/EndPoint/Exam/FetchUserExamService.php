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
use App\Http\Resources\User\Exam\FetchUserExamResource;
use App\Http\Resources\User\Exam\FetchUserExamQuestionResource;
use App\Http\Resources\User\EndPoint\Group\FetchUserSubscriptionGroupResource;
use App\Models\Organization\Exam\ExamGroup;
use App\Models\User;

class FetchUserExamService
{
    public function fetchUserExam($dataRequest): DataStatus
    {
        try {
            /** @var User $user  */
            $user = auth('user')->user();
            $completedExams = ExamResult::where('user_id', $user->id)
                ->pluck('exam_id')
                ->toArray();
            if ($dataRequest->group_id) {
                $examGroups = ExamGroup::where('group_id', $dataRequest->group_id)->pluck('exam_id')->toArray();
            } else {
                $groups =   $user->subscripe_groups()->pluck('group_id')->toArray();
                $examGroups = ExamGroup::whereIn('group_id', $groups)->pluck('exam_id')->toArray();
            }
            $exams = Exam::whereIn('id', $examGroups)
                ->whereNotIn('id', $completedExams)
                ->orderBy('id', 'desc')->get();
            return new DataSuccess(
                status: true,
                message: 'Exam retrieved successfully',
                data: FetchUserExamResource::collection($exams),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
