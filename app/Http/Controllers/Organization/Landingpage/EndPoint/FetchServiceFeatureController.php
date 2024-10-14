<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\ServiceFeature\FetchServiceFeatureService;

class FetchServiceFeatureController  extends Controller
{

    public function __construct(protected FetchServiceFeatureService $fetchServiceFeatureService) {}

    public function __invoke()
    {
        return $this->fetchServiceFeatureService->fetchServiceFeatures()->response();
    }
}
