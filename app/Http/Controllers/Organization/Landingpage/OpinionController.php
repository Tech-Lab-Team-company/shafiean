<?php

namespace App\Http\Controllers\Organization\Landingpage;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Opinion\OpinionService;
use App\Http\Requests\Organization\Landingpage\Opinion\StoreOpinionRequest;
use App\Http\Requests\Organization\Landingpage\Opinion\DeleteOpinionRequest;
use App\Http\Requests\Organization\Landingpage\Opinion\UpdateOpinionRequest;
use App\Http\Requests\Organization\Landingpage\Opinion\FetchOpinionDetailsRequest;

class OpinionController extends Controller
{
    public function __construct(protected  OpinionService $opinionService) {}
    public function index()
    {
        return $this->opinionService->index()->response();
    }
    public function show(FetchOpinionDetailsRequest $request)
    {
        return $this->opinionService->show($request)->response();
    }
    public function store(StoreOpinionRequest $request)
    {
        return $this->opinionService->store($request)->response();
    }
    public function update(UpdateOpinionRequest $request)
    {
        return $this->opinionService->update($request)->response();
    }
    public function delete(DeleteOpinionRequest $request)
    {
        return $this->opinionService->delete($request)->response();
    }
}
