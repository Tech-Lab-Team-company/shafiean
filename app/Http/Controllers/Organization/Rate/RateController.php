<?php

namespace App\Http\Controllers\Organization\Rate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Rate\RateService;
use App\Http\Requests\Oraganization\Rate\AddRateRequest;
use App\Http\Requests\Oraganization\Rate\FetchRateDetailRequest;

class RateController extends Controller
{
    protected $rate_service;

    public function __construct(RateService $rate_service)
    {
        $this->rate_service = $rate_service;
    }

    public function add_rate(AddRateRequest $request){

        return $this->rate_service->add_rate($request)->response();
    }
    public function fetch_rate_details(FetchRateDetailRequest $request){

        return $this->rate_service->fetch_rate_details($request)->response();
    }
}
