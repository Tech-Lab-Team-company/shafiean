<?php

namespace App\Http\Controllers\User\Rate;

use App\Http\Controllers\Controller;
use App\Services\User\Rate\RateService;
use Illuminate\Http\Request;

class RateController extends Controller
{
    protected $rate_service;

    public function __construct(RateService $rate_service)
    {
        $this->rate_service = $rate_service;
    }

    public function add_rate(Request $request){

        return $this->rate_service->add_rate($request)->response();
    }
}
