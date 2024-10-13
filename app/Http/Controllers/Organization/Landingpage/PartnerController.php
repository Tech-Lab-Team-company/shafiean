<?php

namespace App\Http\Controllers\Organization\Landingpage;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Partner\PartnerService;
use App\Http\Requests\Organization\Landingpage\Partner\StorePartnerRequest;
use App\Http\Requests\Organization\Landingpage\Partner\DeletePartnerRequest;
use App\Http\Requests\Organization\Landingpage\Partner\UpdatePartnerRequest;
use App\Http\Requests\Organization\Landingpage\Partner\FetchPartnerDetailsRequest;

class PartnerController extends Controller
{
    public function __construct(protected  PartnerService $partnerService) {}
    public function index()
    {
        return $this->partnerService->index()->response();
    }
    public function show(FetchPartnerDetailsRequest $request)
    {
        return $this->partnerService->show($request)->response();
    }
    public function store(StorePartnerRequest $request)
    {
        return $this->partnerService->store($request)->response();
    }
    public function update(UpdatePartnerRequest $request)
    {
        return $this->partnerService->update($request)->response();
    }
    public function delete(DeletePartnerRequest $request)
    {
        return $this->partnerService->delete($request)->response();
    }
}
