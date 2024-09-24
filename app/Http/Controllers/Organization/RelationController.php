<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Relation\RelationService;
use App\Http\Requests\Organization\Relation\StoreRelationRequest;
use App\Http\Requests\Organization\Relation\DeleteRelationRequest;
use App\Http\Requests\Organization\Relation\UpdateRelationRequest;
use App\Http\Requests\Organization\Relation\FetchRelationDetailsRequest;

class RelationController extends Controller
{
    public function __construct(protected  RelationService $relationService) {}
    public function index()
    {
        return $this->relationService->index()->response();
    }

    public function show(FetchRelationDetailsRequest $request)
    {
        return $this->relationService->show($request)->response();
    }
    public function store(StoreRelationRequest $request)
    {
        return $this->relationService->store($request->validated())->response();
    }
    public function update(UpdateRelationRequest $request)
    {
        return $this->relationService->update($request->validated())->response();
    }
    public function delete(DeleteRelationRequest $request)
    {
        return $this->relationService->delete($request)->response();
    }
}
