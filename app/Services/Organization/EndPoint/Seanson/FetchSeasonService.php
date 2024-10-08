<?php

namespace App\Services\Organization\EndPoint\Seanson;

use Exception;
use App\Models\Season;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Season\FetchSeasonResource;

class FetchSeasonService
{
    public function fetchSeasons()
    {
        try {
            $seasons = Season::get();
            return new DataSuccess(
                data: FetchSeasonResource::collection($seasons),
                status: true,
                message: 'Seasons fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
