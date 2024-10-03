<?php

namespace App\Http\Controllers\User\Competition;

use App\Http\Controllers\Controller;
use App\Services\User\Competition\CompetitionService;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    protected $competition_service;
    public function __construct(CompetitionService $competitionService)
    {
        $this->competition_service = $competitionService;
    }

    public function fetch_competitions(Request $request){

        return $this->competition_service->fetch_competitions()->response();
    }
}
