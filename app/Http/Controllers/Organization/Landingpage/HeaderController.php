<?php

namespace App\Http\Controllers\Organization\Landingpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Landingpage\Header\OrganizationAddHeaderRequest;
use App\Http\Requests\Organization\Landingpage\Header\OrganizationDeleteHeaderRequest;
use App\Http\Requests\Organization\Landingpage\Header\OrganizationEditHeaderRequest;
use App\Http\Requests\Organization\Landingpage\Header\OrganizationFetchHeaderDetailsRequest;
use App\Http\Requests\Organization\Landingpage\Header\OrganizationFetchHeadersRequest;
use App\Services\Organization\Landingpage\Header\HeaderService;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    protected $header_service;

    public function __construct(HeaderService $header_service)
    {
        $this->header_service = $header_service;
    }

    public function organization_fetch_headers(OrganizationFetchHeadersRequest $request)
    {
        return $this->header_service->organization_fetch_headers($request)->response();
    }

    public function organization_fetch_header_details(OrganizationFetchHeaderDetailsRequest $request)
    {
        return $this->header_service->organization_fetch_header_details($request)->response();
    }

    public function organization_add_header(OrganizationAddHeaderRequest $request)
    {
        return $this->header_service->organization_add_header($request)->response();
    }

    public function organization_edit_header(OrganizationEditHeaderRequest $request)
    {
        return $this->header_service->organization_edit_header($request)->response();
    }

    public function organization_delete_header(OrganizationDeleteHeaderRequest $request)
    {
        return $this->header_service->organization_delete_header($request)->response();
    }
}
