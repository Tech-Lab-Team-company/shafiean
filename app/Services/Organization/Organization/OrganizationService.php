<?php

namespace App\Services\Organization\Organization;


use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use App\Models\Teacher;
use App\Services\Global\FilterService;
use Exception;
use Illuminate\Support\Facades\Hash;

class OrganizationService
{
    public function getAllOrganizations($request): DataStatus
    {
        try {
            $query = Organization::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterOrganizations($query, $request);
            }

            $organizations = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

            return new DataSuccess(
                data: OrganizationResource::collection($organizations)->response()->getData(true),
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





    public function getOrganizationById($request): DataStatus
    {
        try {
            $organization = Organization::find($request->id);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                status: true,
                message: 'Organization retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
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
            // dd($organization);
            if ($organization->image != null) {
                // dd($organization->image);
                $employeeImage = upload_image($request->file('image'), 'Teachers/manager');
            }
            $employeeData = [
                'organization_id' => $organization->id,
                'name' => $request->manager_name,
                'phone' => $request->manager_phone,
                'email' => $request->manager_email,
                'password' => '123123123',
                'image' => $employeeImage ?? null,
                'is_master' => 1,
                'is_employed' => 0
            ];
            // dd($employeeData);
            $employee = Teacher::create($employeeData);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                status: true,
                message: 'Organization created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Organization creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateOrganization($request): DataStatus
    {
        try {
            $organization = Organization::find($request->id);

            if ($request->hasFile('image')) {
                if ($organization->image && file_exists($organization->image)) {
                    delete_image($organization->image);
                }
                $image = upload_image($request->file('image'), 'organizations');
                $data['image'] = $image;
            }
            $data['name'] = $request->name ?? $organization->name;
            $data['phone'] = $request->phone ?? $organization->phone;
            $data['email'] = $request->email ?? $organization->email;
            $data['address'] = $request->address ?? $organization->address;
            $data['country_id'] = $request->country_id  ?? $organization->country_id;
            $data['city_id'] = $request->city_id ?? $organization->city_id;
            $data['licence_number'] = $request->licence_number ?? $organization->licence_number;
            $data['website_link'] = $request->website_link ?? $organization->website_link;
            $data['manager_name'] = $request->manager_name ?? $organization->manager_name;
            $data['manager_phone'] = $request->manager_phone ?? $organization->manager_phone;
            $data['manager_email'] = $request->manager_email ?? $organization->manager_email;
            $data['for_all_disabilities'] = $request->for_all_disabilities ?? $organization->for_all_disabilities;
            // dd($data);
            $organization->update($data);
            $organization->disability_types()->sync($request->disability_ids);
            return new DataSuccess(
                data: new OrganizationResource($organization),
                status: true,
                message: 'Organization updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Organization update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteOrganization($request): DataStatus
    {
        try {
            $organization = Organization::find($request->id);
            $organization->delete();
            return new DataSuccess(
                status: true,
                message: 'Organization deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Organization deletion failed: ' . $e->getMessage()
            );
        }
    }
}
