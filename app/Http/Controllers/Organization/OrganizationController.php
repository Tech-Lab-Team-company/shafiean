<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\OrganizationRequest;
use App\Services\OrganizationService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index(Request $request)
    {
        return $this->organizationService->getAllOrganizations($request)->response();

    }

    public function store(OrganizationRequest $request)
    {
        // dd($request->all());
        return $this->organizationService->createOrganization($request)->response();

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

