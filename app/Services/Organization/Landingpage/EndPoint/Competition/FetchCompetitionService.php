<?php

namespace App\Services\Organization\Landingpage\EndPoint\Competition;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Competition\Competition;
use App\Http\Resources\Organization\Landingpage\EndPoint\Competition\FetchCompetitionResource;

class FetchCompetitionService
{
    public function fetchCompetitions()
    {
        try {
            $compitions  = Competition::get();
            return new DataSuccess(
                data: FetchCompetitionResource::collection($compitions),
                status: true,
                message: 'Fetch Competitions successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
