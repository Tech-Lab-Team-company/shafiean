<?php

namespace App\Http\Controllers\Organization\Competition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Competition\AssignCompetitionRewardService;
use App\Http\Requests\Organization\CompetitionReward\EndPoint\AssignCompetitionRewardRequest;

class AssignCompetitionRewardController extends Controller
{
    public function __construct(protected  AssignCompetitionRewardService $assignCompetitionRewardService) {}

    public function assignUser(AssignCompetitionRewardRequest $request)
    {
        return $this->assignCompetitionRewardService->assignUser($request)->response();
    }
}
