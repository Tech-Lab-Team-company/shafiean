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
            // dd($compitions);
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

    public function landing_page_fetch_competition_details($request)
    {
        try {
            $competition  = Competition::where('id', $request->id)->first();
            return new DataSuccess(
                data: new FetchCompetitionResource($competition),
                status: true,
                message: 'Fetch Competition successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
