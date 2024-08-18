<?php

namespace App\Http\Controllers;

use App\Http\Requests\StageRequest;
use App\Http\Resources\StageResource;
use App\Services\StageService;
use Illuminate\Http\Response;

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

