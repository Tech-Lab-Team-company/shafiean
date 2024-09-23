<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Services\Global\GlobalService;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    protected $global_service;

    public function __construct(GlobalService $globalService)
    {
        $this->global_service = $globalService;
    }

    public function fetch_days(Request $request){

        return $this->global_service->fetch_days($request)->response();
    }
}
