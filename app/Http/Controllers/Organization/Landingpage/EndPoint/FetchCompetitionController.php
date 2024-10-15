<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Competition\FetchCompetitionDetailsRequest;
use App\Services\Organization\Landingpage\EndPoint\Competition\FetchCompetitionService;

class FetchCompetitionController  extends Controller
{

    public function __construct(protected FetchCompetitionService $fetchCompetitionService) {}

    public function landing_page_fetch_competitions()
    {
        return $this->fetchCompetitionService->fetchCompetitions()->response();
    }

    public function landing_page_fetch_competition_details(FetchCompetitionDetailsRequest $request){

        return $this->fetchCompetitionService->landing_page_fetch_competition_details($request)->response();
    }
}
