<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Competition\FetchCompetitionService;

class FetchCompetitionController  extends Controller
{

    public function __construct(protected FetchCompetitionService $fetchCompetitionService) {}

    public function __invoke()
    {
        return $this->fetchCompetitionService->fetchCompetitions()->response();
    }
}
