<?php

namespace App\Http\Controllers\Organization\Competition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Competition\CompetitionService;
use App\Http\Requests\Organization\Competition\StoreCompetitionRequest;
use App\Http\Requests\Organization\Competition\DeleteCompetitionRequest;
use App\Http\Requests\Organization\Competition\UpdateCompetitionRequest;
use App\Http\Requests\Organization\Competition\FetchCompetitionDetailsRequest;

class CompetitionController extends Controller
{
    public function __construct(protected  CompetitionService $competitionService) {}

    public function index(Request $request)
    {
        return $this->competitionService->index($request)->response();
    }
    public function show(FetchCompetitionDetailsRequest $request)
    {
        return $this->competitionService->show($request)->response();
    }
    public function store(StoreCompetitionRequest $request)
    {
        return $this->competitionService->store($request->validated())->response();
    }
    public function update(UpdateCompetitionRequest $request)
    {
        return $this->competitionService->update($request->validated())->response();
    }
    public function delete(DeleteCompetitionRequest $request)
    {
        return $this->competitionService->delete($request)->response();
    }
}
