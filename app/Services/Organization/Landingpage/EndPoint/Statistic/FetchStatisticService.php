<?php

namespace App\Services\Organization\Landingpage\EndPoint\Statistic;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Statistic;
use App\Http\Resources\Organization\Landingpage\EndPoint\Statistic\FetchStatisticResource;

class FetchStatisticService
{
    public function fetchStatistics()
    {
        try {
            $statistics  = Statistic::get();
            return new DataSuccess(
                data: FetchStatisticResource::collection($statistics),
                status: true,
                message: 'Fetch Statistics successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
