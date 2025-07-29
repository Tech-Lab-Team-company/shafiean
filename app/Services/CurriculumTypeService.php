<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CurriculumTypeResource;
use App\Models\CurriculumType;
use Exception;

class CurriculumTypeService
{
    public function getAllCurriculumTypes($request): DataStatus
    {
        try {
            if (isset($request->word)) {

                $curriculumTypes = CurriculumType::where('name', 'like', '%' . $request->word . '%')->orderBy('id', 'desc')->paginate(10);
            } else {
                $curriculumTypes = CurriculumType::orderBy('id', 'desc')->paginate(10);
            }
            return new DataSuccess(
                data: CurriculumTypeResource::collection($curriculumTypes)->response()->getData(true),
                status: true,
                message: 'curriculumTypes retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Failed to retrieve curriculumTypes: ' . $e->getMessage()
            );
        }
    }

    public function getCurriculumTypeById($request): DataStatus
    {
        try {
            $curriculumType = CurriculumType::findOrFail($request->id);

            return new DataSuccess(
                data: new CurriculumTypeResource($curriculumType),
                status: true,
                message: 'CurriculumType retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'CurriculumType not found: ' . $e->getMessage()
            );
        }
    }

    public function createCurriculumType($request): DataStatus
    {
        try {
            $data = $request->only(['name', 'description']);
            $curriculumType = CurriculumType::create($data);

            return new DataSuccess(
                data: new CurriculumTypeResource($curriculumType),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'CurriculumType creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateCurriculumType($request): DataStatus
    {
        try {
            $curriculumType = CurriculumType::findOrFail($request->id);
            $data['name'] = $request->name ?? $curriculumType->name;
            $data['description'] = $request->description ?? $curriculumType->description;
            $curriculumType->update($data);

            return new DataSuccess(
                data: new CurriculumTypeResource($curriculumType),
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'CurriculumType update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCurriculumType($request): DataStatus
    {
        try {
            $curriculumType = CurriculumType::findOrFail($request->id);
            $curriculumType->delete();

            return new DataSuccess(
                status: true,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'CurriculumType deletion failed: ' . $e->getMessage()
            );
        }
    }
}
