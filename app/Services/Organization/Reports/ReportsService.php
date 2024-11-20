<?php

namespace App\Services\Organization\Reports;

use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Report\ReportResource;
use App\Http\Resources\Organization\Subscription\SubscriptionResource;
use App\Models\Organization\Competition\Competition;

class ReportsService
{
    public function competitionReport()
    {
        try {
            $competition = Competition::all();
            return new DataSuccess(
                data: ReportResource::collection($competition)->response()->getData(true),
                status: true,
                message: 'Subscription fetched successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
