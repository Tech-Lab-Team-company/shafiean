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
use App\Http\Resources\User\Report\CompetitionReportResource;
use App\Http\Resources\User\Report\AttendanceAndDepartureReportResource;

class ReportsService
{
    public function competitionReport()
    {
        try {
            /**
             * @var User
             */
            $user = Auth::guard('user')->user();
            $competitions = $user->competitions()->paginate(5);
            return new DataSuccess(
                data: CompetitionReportResource::collection($competitions)->response()->getData(true),
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
    public function AttendanceAndDepartureReport()
    {
        try {
            $groupStageSessions = GroupStageSession::paginate(5);
            return new DataSuccess(
                data: AttendanceAndDepartureReportResource::collection($groupStageSessions)->response()->getData(true),
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
    public function examReport()
    {
        try {
            $user = Auth::guard('user')->user();
            $groupIds = Subscription::where('user_id', $user->id)->pluck('group_id')->toArray();
            $examIds = ExamGroup::whereIn('group_id', $groupIds)->pluck('exam_id')->toArray();
            $exam = Exam::whereIn('id', $examIds)->paginate(5);
            return new DataSuccess(
                data: ExamReportResource::collection($exam)->response()->getData(true),
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
