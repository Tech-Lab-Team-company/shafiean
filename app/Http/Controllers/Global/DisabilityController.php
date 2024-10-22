<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Services\Global\DisabilityService;
use Illuminate\Http\Request;

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
}
