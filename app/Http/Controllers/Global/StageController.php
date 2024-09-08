<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stage\AddStageRequest;
use App\Http\Requests\Stage\ChangeStageActiveStatusRequest;
use App\Http\Requests\Stage\DeleteStageRequest;
use App\Http\Requests\Stage\EditStageRequest;
use App\Http\Requests\Stage\FetchStageDetailsRequest;
use App\Http\Requests\Stage\FetchStagesRequest;
use App\Http\Requests\Stage\StageRequest;
use App\Services\StageService;
use Illuminate\Http\Request;

class StageController extends Controller
{
    protected $stageService;

    public function __construct(StageService $stageService)
    {
        $this->stageService = $stageService;
    }

    public function index(FetchStagesRequest $request)
    {
        return $this->stageService->getAllStages($request)->response();

    }

    public function store(AddStageRequest $request)
    {
       return $this->stageService->createStage($request)->response();

    }

    public function show(FetchStageDetailsRequest $request)
    {
        return $this->stageService->getStageById($request)->response();

    }

    public function update(EditStageRequest $request)
    {
       return $this->stageService->updateStage( $request)->response();

    }

    public function destroy(DeleteStageRequest $request)
    {
        return $this->stageService->deleteStage($request)->response();

    }

    public function changeActiveStatus(ChangeStageActiveStatusRequest $request)
    {
        return $this->stageService->changeStageActiveStatus($request)->response();
    }
}

