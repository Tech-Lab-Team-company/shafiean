<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Exception;

class OrganizationService
{
    public function getAllOrganizations(): DataStatus
    {
        try {
            $organizations = Organization::all();
            return new DataSuccess(
                data: OrganizationResource::collection($organizations),
                statusCode: 200,
                message: 'Organizations retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve organizations: ' . $e->getMessage()
            );
        }
    }

    public function getOrganizationById($id): DataStatus
    {
        try {
            $organization = Organization::findOrFail($id);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                statusCode: 200,
                message: 'Organization retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Organization not found: ' . $e->getMessage()
            );
        }
    }

    public function createOrganization(array $data): DataStatus
    {
        try {
            $organization = Organization::create($data);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                statusCode: 201,
                message: 'Organization created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Organization creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateOrganization($id, array $data): DataStatus
    {
        try {
            $organization = Organization::findOrFail($id);
            $organization->update($data);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                statusCode: 200,
                message: 'Organization updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Organization update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteOrganization($id): DataStatus
    {
        try {
            $organization = Organization::findOrFail($id);
            $organization->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Organization deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Organization deletion failed: ' . $e->getMessage()
            );
        }
    }
}

