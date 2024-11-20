<?php

namespace App\Http\Controllers\User\Competition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Competition\CompetitionService;
use App\Http\Requests\User\Competition\JoinCompetitionRequest;
use App\Http\Requests\User\Competition\FetchCompetitionRequest;
use App\Http\Requests\User\Competition\FetchCompetitionDetailRequest;

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
    public function fetch_competition_details(FetchCompetitionDetailRequest $request){
        return $this->competition_service->fetch_competition_details( $request)->response();
    }
    public function join_competition(JoinCompetitionRequest $request){
        return $this->competition_service->join_competition( $request)->response();
    }
}
