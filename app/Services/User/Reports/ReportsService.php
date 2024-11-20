<?php

namespace App\Services\User\Reports;


use App\Models\User;
use App\Models\Subscription;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\Report\CompetitionReportResource;

class ReportsService
{
    public function competitionReport()
    {
        try {
            /**
             * @var User
             */
            $user = Auth::guard('user')->user();
            $competitions = $user->competitions;
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
          $groupStageSessions=GroupStageSession::all();
            $competitions = $user->competitions;
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
}
