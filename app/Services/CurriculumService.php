<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CurriculumResource;
use App\Models\Curriculum;
use Exception;

class CurriculumService
{
    public function getAllCurriculums(): DataStatus
    {
        try {
            $curriculums = Curriculum::all();
            return new DataSuccess(
                data: CurriculumResource::collection($curriculums),
                statusCode: 200,
                message: 'Curriculums retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve curriculums: ' . $e->getMessage()
            );
        }
    }

    public function getCurriculumById($id): DataStatus
    {
        try {
            $curriculum = Curriculum::findOrFail($id);

            return new DataSuccess(
                data: new CurriculumResource($curriculum),
                statusCode: 200,
                message: 'Curriculum retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Curriculum not found: ' . $e->getMessage()
            );
        }
    }

    public function createCurriculum(array $data): DataStatus
    {
        try {
            $curriculum = Curriculum::create($data);

            return new DataSuccess(
                data: new CurriculumResource($curriculum),
                statusCode: 201,
                message: 'Curriculum created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Curriculum creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateCurriculum($id, array $data): DataStatus
    {
        try {
            $curriculum = Curriculum::findOrFail($id);
            $curriculum->update($data);

            return new DataSuccess(
                data: new CurriculumResource($curriculum),
                statusCode: 200,
                message: 'Curriculum updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Curriculum update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCurriculum($id): DataStatus
    {
        try {
            $curriculum = Curriculum::findOrFail($id);
            $curriculum->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'Curriculum deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Curriculum deletion failed: ' . $e->getMessage()
            );
        }
    }
}

