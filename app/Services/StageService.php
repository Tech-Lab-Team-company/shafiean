<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use Exception;

class StageService
{
    public function getAllStages(): DataStatus
    {
        try {
            $stages = Stage::all();
            return new DataSuccess(
                data: StageResource::collection($stages),
                statusCode: 200,
                message: 'Stages retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve stages: ' . $e->getMessage()
            );
        }
    }

    public function getStageById($id): DataStatus
    {
        try {
            $stage = Stage::findOrFail($id);
            return new DataSuccess(
                data: new StageResource($stage),
                statusCode: 200,
                message: 'Stage retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Stage not found: ' . $e->getMessage()
            );
        }
    }

    public function createStage(array $data): DataStatus
    {
        try {
            $stage = Stage::create($data);
            return new DataSuccess(
                data: new StageResource($stage),
                statusCode: 201,
                message: 'Stage created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Stage creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateStage($id, array $data): DataStatus
    {
        try {
            $stage = Stage::findOrFail($id);
            $stage->update($data);
            return new DataSuccess(
                data: new StageResource($stage),
                statusCode: 200,
                message: 'Stage updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Stage update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteStage($id): DataStatus
    {
        try {
            $stage = Stage::findOrFail($id);
            $stage->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Stage deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Stage deletion failed: ' . $e->getMessage()
            );
        }
    }
}
