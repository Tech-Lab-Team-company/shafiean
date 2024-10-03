<?php

namespace App\Services\User\Competition;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Competition\CompetitionResource;
use App\Models\Organization\Competition\Competition;

class CompetitionService
{

    public function fetch_competitions(): DataStatus
    {
        try {
            $competitions = Competition::paginate(10);
            return new DataSuccess(
                status: true,
                data: CompetitionResource::collection($competitions)->response()->getData(true),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
