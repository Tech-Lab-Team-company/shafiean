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
    public function getAllOrganizations($request): DataStatus
    {
        try {
            $query = Organization::query();

            if ($request) {
                $this->applyFilters($query, $request);
            }

            $organizations = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

            return new DataSuccess(
                data: OrganizationResource::collection($organizations),
                status: true,
                message: 'Organizations retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Failed to retrieve organizations: ' . $e->getMessage()
            );
        }
    }

    private function applyFilters($query, $request): void
    {
        if ($request->filled('word') && !$request->filled('city_ids') && !$request->filled('country_ids')) {
            $query->where('name', 'like', '%' . $request->word . '%');
        }

        if ($request->filled('city_ids') && !$request->filled('word') && !$request->filled('country_ids')) {
            $query->orWhereIn('city_id', $request->city_ids);
        }

        if ($request->filled('country_ids') && !$request->filled('word') && !$request->filled('city_ids')) {
            $query->orWhereIn('country_id', $request->country_ids);
        }

        if ($request->filled(['city_ids', 'word']) && !$request->filled('country_ids')) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('city_id', $request->city_ids)
                    ->where('name', 'like', '%' . $request->word . '%');
            });
        }

        if ($request->filled(['country_ids', 'word']) && !$request->filled('city_ids')) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('country_id', $request->country_ids)
                    ->where('name', 'like', '%' . $request->word . '%');
            });
        }

        if ($request->filled(['country_ids', 'city_ids']) && !$request->filled('word')) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('country_id', $request->country_ids)
                    ->whereIn('city_id', $request->city_ids);
            });
        }

        if ($request->filled(['country_ids', 'city_ids', 'word'])) {
            $query->orWhere(function ($q) use ($request) {
                $q->whereIn('country_id', $request->country_ids)
                    ->whereIn('city_id', $request->city_ids)
                    ->where('name', 'like', '%' . $request->word . '%');
            });
        }
    }



    public function getOrganizationById($id): DataStatus
    {
        try {
            $organization = Organization::find($id);
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

    public function createOrganization($request): DataStatus
    {
        try {
            if ($request->hasFile('image')) {
                $image = upload_image($request->file('image'), 'organizations');
                $data['image'] = $image;
            }
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['country_id'] = $request->country_id;
            $data['city_id'] = $request->city_id;
            $data['licence_number'] = $request->licence_number;
            $data['website_link'] = $request->website_link;
            $data['manager_name'] = $request->manager_name;
            $data['manager_phone'] = $request->manager_phone;
            $data['manager_email'] = $request->manager_email;
            $data['for_all_disabilities'] = $request->for_all_disabilities;
            // dd($data);
            $organization = Organization::create($data);
            $organization->disability_types()->attach($request->disability_ids);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                statusCode: 200,
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
            $organization = Organization::find($id);
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
            $organization = Organization::find($id);
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
