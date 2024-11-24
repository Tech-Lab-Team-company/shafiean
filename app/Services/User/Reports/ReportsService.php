<?php

namespace App\Services\User\Reports;


use App\Models\User;
use App\Models\Subscription;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamGroup;
use App\Http\Resources\User\Report\ExamReportResource;
use App\Http\Resources\User\Report\AcademyReportResource;
use App\Http\Resources\User\Report\CompetitionReportResource;
use App\Http\Resources\User\Report\AttendanceAndDepartureReportResource;

class ReportsService
{
    public function competitionReport($dataRequest)
    {
        try {
            /**
             * @var User
             */
            $user = Auth::guard('user')->user();
            $competitions = $user->competitions();
            $competitions->when($dataRequest->word, function ($query) use ($dataRequest) {
                $query->where('name', 'like', '%' . $dataRequest->word . '%');
            });
            $data = $competitions->paginate(5);
            return new DataSuccess(
                data: CompetitionReportResource::collection($data)->response()->getData(true),
                status: true,
                message: 'Competition Report'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function AttendanceAndDepartureReport($dataRequest)
    {
        try {
            $groupStageSessions = GroupStageSession::query();
            $groupStageSessions->when($dataRequest->word, function ($query) use ($dataRequest) {
                $query->whereHas('session', function ($q) use ($dataRequest) {
                    $q->where('title', 'like', '%' . $dataRequest->word . '%');
                })->orWhereHas('group.teacher', function ($q) use ($dataRequest) {
                    $q->where('name', 'like', '%' . $dataRequest->word . '%');
                });
            });
            $data = $groupStageSessions->paginate(5);
            return new DataSuccess(
                data: AttendanceAndDepartureReportResource::collection($data)->response()->getData(true),
                status: true,
                message: 'Attendance And Departure Report'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function examReport($dataRequest)
    {
        try {
            $user = Auth::guard('user')->user();
            $groupIds = Subscription::where('user_id', $user->id)->pluck('group_id')->toArray();
            $examIds = ExamGroup::whereIn('group_id', $groupIds)->pluck('exam_id')->toArray();
            $exam = Exam::whereIn('id', $examIds);
            $exam->when($dataRequest->word, function ($query) use ($dataRequest) {
                $query->where('name', 'like', '%' . $dataRequest->word . '%');
            });
            $data = $exam->paginate(5);
            return new DataSuccess(
                data: ExamReportResource::collection($data)->response()->getData(true),
                status: true,
                message: 'Exam Report'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function academyReport($dataRequest)
    {
        try {
            /**
             * @var User
             */
            $user = Auth::guard('user')->user();
            $examResult = $user->examResults();
            $examResult->when($dataRequest->word, function ($query) use ($dataRequest) {
                $query->whereHas('exam', function ($q) use ($dataRequest) {
                    $q->where('name', 'like', '%' . $dataRequest->word . '%');
                });
            });
            $data = $examResult->paginate(5);
            return new DataSuccess(
                data: AcademyReportResource::collection($data)->response()->getData(true),
                status: true,
                message: 'Exam Report'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
