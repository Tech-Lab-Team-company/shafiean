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
    public function getAllCurriculums($request): DataStatus
    {
        try {
            if (isset($request->word)) {
                $curriculums = Curriculum::where('title', 'like', '%' . $request->word . '%')->orderBy('id', 'desc')->paginate(10);
            }
            $curriculums = Curriculum::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: CurriculumResource::collection($curriculums)->response()->getData(true),
                status: true,
                message: 'Curriculums retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Failed to retrieve curriculums: ' . $e->getMessage()
            );
        }
    }

    public function getCurriculumById($request): DataStatus
    {
        try {
            $curriculum = Curriculum::find($request->id);

            return new DataSuccess(
                data: new CurriculumResource($curriculum),
                status: true,
                message: 'Curriculum retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Curriculum not found: ' . $e->getMessage()
            );
        }
    }

    public function createCurriculum($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['type'] = $request->type;
            $curriculum = Curriculum::create($data);

            return new DataSuccess(
                data: new CurriculumResource($curriculum),
                status: true,
                message: 'Curriculum created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: true,
                message: 'Curriculum creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateCurriculum($request): DataStatus
    {
        try {
            $curriculum = Curriculum::find($request->id);
            $data['title'] = $request->title;
            $data['type'] = $request->type;
            $curriculum->update($data);

            return new DataSuccess(
                data: new CurriculumResource($curriculum),
                status: true,
                message: 'Curriculum updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Curriculum update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCurriculum($request): DataStatus
    {
        try {
            $curriculum = Curriculum::find($request->id);
            $curriculum->delete();

            return new DataSuccess(
                status: true,
                message: 'Curriculum deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Curriculum deletion failed: ' . $e->getMessage()
            );
        }
    }
}
