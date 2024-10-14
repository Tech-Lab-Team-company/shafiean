<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Service\FetchServiceLandingService;

class FetchServiceController  extends Controller
{

    public function __construct(protected FetchServiceLandingService $fetchServiceLandingService) {}

    public function __invoke()
    {
        return $this->fetchServiceLandingService->fetchServices()->response();
    }
}
