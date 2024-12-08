<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use App\Services\Global\FilterService;
use Exception;

class StageService
{
    public function getAllStages($request): DataStatus
    {
        try {
            $query = Stage::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterStages($request, $query);
            }
            $stages = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: StageResource::collection($stages)->response()->getData(true),
                status: true,
                message: 'Stages retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Failed to retrieve stages: ' . $e->getMessage()
            );
        }
    }

    public function getStageById($request): DataStatus
    {
        try {
            $stage = Stage::find($request->id);
            return new DataSuccess(
                data: new StageResource($stage),
                status: true,
                message: 'Stage retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Stage not found: ' . $e->getMessage()
            );
        }
    }

    public function createStage($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['curriculum_id'] = $request->curriculum_id;
            $stage = Stage::create($data);
            $stage->disabilityTypes()->attach($request->disability_ids);
            $stage->surahs()->attach($request->surah_ids);
            return new DataSuccess(
                data: new StageResource($stage),
                statusCode: 200,
                message: 'Stage created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Stage creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateStage($request): DataStatus
    {
        try {
            $stage = Stage::find($request->id);
            $data['title'] = $request->title ?? $stage->title;
            $data['description'] = $request->description ?? $stage->description;
            $data['curriculum_id'] = $request->curriculum_id ?? $stage->curriculum_id;
            $stage->update($data);
            $stage->disabilityTypes()->sync($request->disability_ids);
            $stage->quraan()->sync($request->quraan_ids);
            return new DataSuccess(
                data: new StageResource($stage),
                status: true,
                message: 'Stage updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Stage update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteStage($request): DataStatus
    {
        try {
            $stage = Stage::find($request->id);
            $stage->delete();
            return new DataSuccess(
                status: true,
                message: 'Stage deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Stage deletion failed: ' . $e->getMessage()
            );
        }
    }

    public function changeStageActiveStatus($request): DataStatus
    {
        try {
            $stage = Stage::find($request->id);
            $stage->status ? $stage->status = 0 : $stage->status = 1;
            $stage->update();
            return new DataSuccess(
                status: true,
                data: new StageResource($stage),
                message: 'Stage status changed successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Stage status change failed: ' . $e->getMessage()
            );
        }
    }
}
