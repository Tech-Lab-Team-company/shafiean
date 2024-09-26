<?php

namespace App\Http\Controllers\Organization\Organization;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\OrganizationRequest;
use App\Http\Requests\Organization\DeleteOrganizationRequest;
use App\Http\Requests\Organization\OrganizationUpdateRequest;
use App\Services\Organization\Organization\OrganizationService;
use App\Http\Requests\Organization\FetchOrganizationDetailRequest;

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

    public function show(FetchOrganizationDetailRequest $request)
    {
        return $this->organizationService->getOrganizationById($request)->response();
    }

    public function update(OrganizationUpdateRequest $request)
    {
        // dd($request->all());
        return $this->organizationService->updateOrganization($request)->response();
    }

    public function destroy(DeleteOrganizationRequest $request)
    {
        return $this->organizationService->deleteOrganization($request)->response();
    }
}
