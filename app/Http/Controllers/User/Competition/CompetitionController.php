<?php

namespace App\Http\Controllers\User\Competition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Competition\CompetitionService;
use App\Http\Requests\User\Competition\FetchCompetitionRequest;

class CompetitionController extends Controller
{
    protected $competition_service;
    public function __construct(CompetitionService $competitionService)
    {
        $this->competition_service = $competitionService;
    }

    public function fetch_competitions(FetchCompetitionRequest $request){

        return $this->competition_service->fetch_competitions( $request)->response();
    }
}
