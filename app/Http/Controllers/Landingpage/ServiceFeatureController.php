<?php

namespace App\Http\Controllers\Landingpage;

use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\ServiceFeature\ServiceFeatureService;
use Illuminate\Http\Request;

class ServiceFeatureController extends Controller
{
    protected $service_feature_service;

    public function __construct(ServiceFeatureService $serviceFeatureService)
    {
        $this->service_feature_service = $serviceFeatureService;
    }

    public function organization_fetch_service_features(Request $request)
    {
        return $this->service_feature_service->organization_fetch_service_features($request)->response();
    }

    public function organization_fetch_service_feature_details(Request $request)
    {
        return $this->service_feature_service->organization_fetch_service_feature_details($request)->response();
    }

    public function organization_add_service_feature(Request $request)
    {
        return $this->service_feature_service->organization_add_service_feature($request)->response();
    }

    public function organization_edit_service_feature(Request $request)
    {
        return $this->service_feature_service->organization_edit_service_feature($request)->response();
    }

    public function organization_delete_service_feature(Request $request)
    {
        return $this->service_feature_service->organization_delete_service_feature($request)->response();
    }
}
