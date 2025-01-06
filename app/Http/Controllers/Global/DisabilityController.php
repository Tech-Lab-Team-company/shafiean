<?php

namespace App\Http\Controllers\Global;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Global\DisabilityService;
use App\Http\Requests\DisabilityType\FetchDisabilityByStageRequest;

class DisabilityController extends Controller
{
    protected $disability_service;

    public function __construct(DisabilityService $disability_service)
    {
        $this->disability_service = $disability_service;
    }

    public function fetch_disabilities()
    {
        return $this->disability_service->fetach_disabilities()->response();
    }
    public function fetchDisabilityByStageIds(FetchDisabilityByStageRequest $request)
    {
        return $this->disability_service->fetchDisabilityByStageIds($request)->response();
    }
}
