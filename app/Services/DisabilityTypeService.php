<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\DisabilityTypeResource;
use App\Models\DisabilityType;
use Exception;

class DisabilityTypeService
{
    public function getAll(): DataStatus
    {
        try {
            $disabilityTypes = DisabilityType::all();
            return new DataSuccess(
                data: DisabilityTypeResource::collection($disabilityTypes),
                statusCode: 200,
                message: 'Disability types retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve disability types: ' . $e->getMessage()
            );
        }
    }

    public function getById($id): DataStatus
    {
        try {
            $disabilityType = DisabilityType::findOrFail($id);
            return new DataSuccess(
                data: new DisabilityTypeResource($disabilityType),
                statusCode: 200,
                message: 'Disability type retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Disability type not found: ' . $e->getMessage()
            );
        }
    }

    public function create(array $data): DataStatus
    {
        try {
            $disabilityType = DisabilityType::create($data);
            return new DataSuccess(
                data: new DisabilityTypeResource($disabilityType),
                statusCode: 201,
                message: 'Disability type created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Disability type creation failed: ' . $e->getMessage()
            );
        }
    }

    public function update($id, array $data): DataStatus
    {
        try {
            $disabilityType = DisabilityType::findOrFail($id);
            $disabilityType->update($data);
            return new DataSuccess(
                data: new DisabilityTypeResource($disabilityType),
                statusCode: 200,
                message: 'Disability type updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Disability type update failed: ' . $e->getMessage()
            );
        }
    }

    public function delete($id): DataStatus
    {
        try {
            $disabilityType = DisabilityType::findOrFail($id);
            $disabilityType->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Disability type deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Disability type deletion failed: ' . $e->getMessage()
            );
        }
    }
}

