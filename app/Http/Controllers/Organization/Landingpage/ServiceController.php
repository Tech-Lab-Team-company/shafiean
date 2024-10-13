<?php

namespace App\Http\Controllers\Organization\Landingpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Service\ServiceLandingService;
use App\Http\Requests\Organization\Landingpage\Service\StoreServiceRequest;
use App\Http\Requests\Organization\Landingpage\Service\DeleteServiceRequest;
use App\Http\Requests\Organization\Landingpage\Service\UpdateServiceRequest;
use App\Http\Requests\Organization\Landingpage\Service\FetchServiceDetailsRequest;

class ServiceController extends Controller
{
    public function __construct(protected  ServiceLandingService $serviceLandingService) {}
    public function index()
    {
        return $this->serviceLandingService->index()->response();
    }
    public function show(FetchServiceDetailsRequest $request)
    {
        return $this->serviceLandingService->show($request)->response();
    }
    public function store(StoreServiceRequest $request)
    {
        return $this->serviceLandingService->store($request)->response();
    }
    public function update(UpdateServiceRequest $request)
    {
        return $this->serviceLandingService->update($request)->response();
    }
    public function delete(DeleteServiceRequest $request)
    {
        return $this->serviceLandingService->delete($request)->response();
    }
}
