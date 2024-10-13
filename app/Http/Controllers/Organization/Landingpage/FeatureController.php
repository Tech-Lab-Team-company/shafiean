<?php

namespace App\Http\Controllers\Organization\Landingpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Landingpage\Feature\OrganizationAddFeatureRequest;
use App\Http\Requests\Organization\Landingpage\Feature\OrganizationDeleteFeatureRequest;
use App\Http\Requests\Organization\Landingpage\Feature\OrganizationEditFeatureRequest;
use App\Http\Requests\Organization\Landingpage\Feature\OrganizationFetchFeatureDetailsRequest;
use App\Http\Requests\Organization\Landingpage\Feature\OrganizationFetchFeaturesRequest;
use App\Services\Organization\Landingpage\Feature\FeatureService;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    protected $feature_service;

    public function __construct(FeatureService $featureService)
    {
        $this->feature_service = $featureService;
    }

    public function organization_fetch_features(OrganizationFetchFeaturesRequest $request)
    {
        return $this->feature_service->organization_fetch_features($request)->response();
    }

    public function organization_fetch_feature_details(OrganizationFetchFeatureDetailsRequest $request)
    {
        return $this->feature_service->organization_fetch_feature_details($request)->response();
    }

    public function organization_add_feature(OrganizationAddFeatureRequest $request)
    {
        return $this->feature_service->organization_add_feature($request)->response();
    }

    public function organization_edit_feature(OrganizationEditFeatureRequest $request)
    {
        return $this->feature_service->organization_edit_feature($request)->response();
    }

    public function organization_delete_feature(OrganizationDeleteFeatureRequest $request)
    {
        return $this->feature_service->organization_delete_feature($request)->response();
    }
}
