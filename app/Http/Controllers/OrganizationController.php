<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index()
    {
        $organizations = $this->organizationService->getAllOrganizations();
        return OrganizationResource::collection($organizations);
    }

    public function store(OrganizationRequest $request)
    {
        $organization = $this->organizationService->createOrganization($request->validated());
        return new OrganizationResource($organization);
    }

    public function show($id)
    {
        $organization = $this->organizationService->getOrganizationById($id);
        return new OrganizationResource($organization);
    }

    public function update(OrganizationRequest $request, $id)
    {
        $organization = $this->organizationService->updateOrganization($id, $request->validated());
        return new OrganizationResource($organization);
    }

    public function destroy($id)
    {
        $this->organizationService->deleteOrganization($id);
        return response()->json(['message' => 'organization deleted successfully.'], 200);
    }
}

