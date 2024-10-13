<?php

namespace App\Http\Controllers\Organization\Landingpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Landingpage\Subheader\OrganizationAddSubheaderRequest;
use App\Http\Requests\Organization\Landingpage\Subheader\OrganizationDeleteSubheaderRequest;
use App\Http\Requests\Organization\Landingpage\Subheader\OrganizationEditSubheaderRequest;
use App\Http\Requests\Organization\Landingpage\Subheader\OrganizationFetchSubheaderDetailsRequest;
use App\Http\Requests\Organization\Landingpage\Subheader\OrganizationFetchSubheadersRequest;
use App\Services\Organization\Landingpage\Subheader\SubheaderService;
use Illuminate\Http\Request;

class SubheaderController extends Controller
{
    protected $subheader_service;

    public function __construct(SubheaderService $subheader_service)
    {
        $this->subheader_service = $subheader_service;
    }

    public function organization_fetch_subheaders(OrganizationFetchSubheadersRequest $request)
    {
        return $this->subheader_service->organization_fetch_subheaders($request)->response();
    }

    public function organization_fetch_subheader_details(OrganizationFetchSubheaderDetailsRequest $request)
    {
        return $this->subheader_service->organization_fetch_subheader_details($request)->response();
    }

    public function organization_add_subheader(OrganizationAddSubheaderRequest $request)
    {
        return $this->subheader_service->organization_add_subheader($request)->response();
    }

    public function organization_edit_subheader(OrganizationEditSubheaderRequest $request)
    {
        return $this->subheader_service->organization_edit_subheader($request)->response();
    }

    public function organization_delete_subheader(OrganizationDeleteSubheaderRequest $request)
    {
        return $this->subheader_service->organization_delete_subheader($request)->response();
    }
}
