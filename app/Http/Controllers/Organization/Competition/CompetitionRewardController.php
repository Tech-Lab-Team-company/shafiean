<?php

namespace App\Http\Controllers\Organization\Competition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Competition\CompetitionRewardService;
use App\Http\Requests\Organization\CompetitionReward\StoreCompetitionRewardRequest;
use App\Http\Requests\Organization\CompetitionReward\DeleteCompetitionRewardRequest;
use App\Http\Requests\Organization\CompetitionReward\UpdateCompetitionRewardRequest;
use App\Http\Requests\Organization\CompetitionReward\FetchCompetitionRewardDetailsRequest;

class CompetitionRewardController extends Controller
{
    public function __construct(protected  CompetitionRewardService $competitionRewardService) {}

    public function index()
    {
        return $this->competitionRewardService->index()->response();
    }
    public function show(FetchCompetitionRewardDetailsRequest $request)
    {
        return $this->competitionRewardService->show($request)->response();
    }
    public function store(StoreCompetitionRewardRequest $request)
    {
        return $this->competitionRewardService->store($request->validated())->response();
    }
    public function update(UpdateCompetitionRewardRequest $request)
    {
        return $this->competitionRewardService->update($request->validated())->response();
    }
    public function delete(DeleteCompetitionRewardRequest $request)
    {
        return $this->competitionRewardService->delete($request)->response();
    }
}
