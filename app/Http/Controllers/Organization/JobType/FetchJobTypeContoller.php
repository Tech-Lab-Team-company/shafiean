<?php

namespace App\Http\Controllers\Organization\JobType;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\JobType\FetchJobTypeService;

class FetchJobTypeContoller extends Controller
{
    public function __construct(protected FetchJobTypeService $fetchJobTypeService) {}
    public function __invoke()
    {
        return $this->fetchJobTypeService->fetchJobTypes()->response();
    }
}
