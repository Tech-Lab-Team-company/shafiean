<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stage\StageRequest;
use App\Services\StageService;

class StageController extends Controller
{
    protected $stageService;

    public function __construct(StageService $stageService)
    {
        $this->stageService = $stageService;
    }

    public function index()
    {
        return $this->stageService->getAllStages()->response();

    }

    public function store(StageRequest $request)
    {
       return $this->stageService->createStage($request->validated())->response();

    }

    public function show($id)
    {
        return $this->stageService->getStageById($id)->response();

    }

    public function update(StageRequest $request, $id)
    {
       return $this->stageService->updateStage($id, $request->validated())->response();

    }

    public function destroy($id)
    {
        return $this->stageService->deleteStage($id)->response();

    }
}

