<?php

namespace App\Http\Controllers\Organization\Landingpage;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Privacy\PrivacyService;
use App\Http\Requests\Organization\Landingpage\Privacy\StorePrivacyRequest;
use App\Http\Requests\Organization\Landingpage\Privacy\DeletePrivacyRequest;
use App\Http\Requests\Organization\Landingpage\Privacy\UpdatePrivacyRequest;
use App\Http\Requests\Organization\Landingpage\Privacy\FetchPrivacyDetailsRequest;

class PrivacyController extends Controller
{
    public function __construct(protected  PrivacyService $privacyService) {}
    public function index()
    {
        return $this->privacyService->index()->response();
    }
    public function show(FetchPrivacyDetailsRequest $request)
    {
        return $this->privacyService->show($request)->response();
    }
    public function store(StorePrivacyRequest $request)
    {
        return $this->privacyService->store($request)->response();
    }
    public function update(UpdatePrivacyRequest $request)
    {
        return $this->privacyService->update($request)->response();
    }
    public function delete(DeletePrivacyRequest $request)
    {
        return $this->privacyService->delete($request)->response();
    }
}
