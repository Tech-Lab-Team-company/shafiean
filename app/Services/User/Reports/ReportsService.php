<?php

namespace App\Services\User\Reports;


use App\Models\User;
use App\Models\Subscription;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
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
                message: 'Competition Report'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
