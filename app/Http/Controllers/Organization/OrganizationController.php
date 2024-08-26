<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\OrganizationRequest;
use App\Services\OrganizationService;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index()
    {
        return $this->organizationService->getAllOrganizations()->response();

    }

    public function store(OrganizationRequest $request)
    {
        return $this->organizationService->createOrganization($request->validated())->response();

    }

    public function show($id)
    {
        return $this->organizationService->getOrganizationById($id)->response();

    }

    public function update(OrganizationRequest $request, $id)
    {
        return $this->organizationService->updateOrganization($id, $request->validated())->response();

    }

    public function destroy($id)
    {
       return $this->organizationService->deleteOrganization($id)->response();

    }
}

