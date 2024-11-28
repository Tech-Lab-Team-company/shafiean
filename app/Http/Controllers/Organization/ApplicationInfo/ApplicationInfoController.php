<?php

namespace App\Http\Controllers\Organization\ApplicationInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\ApplicationInfo\ApplicationInfoService;
use App\Http\Requests\Organization\ApplicationInfo\StoreApplicationInfoRequest;
use App\Http\Requests\Organization\ApplicationInfo\DeleteApplicationInfoRequest;
use App\Http\Requests\Organization\ApplicationInfo\UpdateApplicationInfoRequest;
use App\Http\Requests\Organization\ApplicationInfo\FetchApplicationInfoDetailsRequest;

class ApplicationInfoController extends Controller
{
    public function __construct(protected ApplicationInfoService $applicationInfoService) {}
    public function show(FetchApplicationInfoDetailsRequest $request)
    {
        return $this->applicationInfoService->show($request)->response();
    }
    public function store(StoreApplicationInfoRequest $request)
    {
        return $this->applicationInfoService->store($request)->response();
    }
}
