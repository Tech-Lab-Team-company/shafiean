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
        $stages = $this->stageService->getAllStages();
        return StageResource::collection($stages);
    }

    public function store(StageRequest $request)
    {
        $stage = $this->stageService->createStage($request->validated());
        return new StageResource($stage);
    }

    public function show($id)
    {
        $stage = $this->stageService->getStageById($id);
        return new StageResource($stage);
    }

    public function update(StageRequest $request, $id)
    {
        $stage = $this->stageService->updateStage($id, $request->validated());
        return new StageResource($stage);
    }

    public function destroy($id)
    {
        $this->stageService->deleteStage($id);
        return response()->json(['message' => 'Stage deleted successfully.'], 200);
    }
}

