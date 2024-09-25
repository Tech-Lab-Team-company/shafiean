<?php

namespace App\Http\Controllers\Organization\UserRelation;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Relation\RelationService;
use App\Services\Organization\UserRelation\UserRelationService;
use App\Http\Requests\Organization\Relation\StoreRelationRequest;
use App\Http\Requests\Organization\Relation\DeleteRelationRequest;
use App\Http\Requests\Organization\Relation\UpdateRelationRequest;
use App\Http\Requests\Organization\Relation\FetchRelationDetailsRequest;
use App\Http\Requests\Organization\UserRelation\StoreUserRelationRequest;
use App\Http\Requests\Organization\UserRelation\DeleteUserRelationRequest;
use App\Http\Requests\Organization\UserRelation\UpdateUserRelationRequest;
use App\Http\Requests\Organization\UserRelation\FetchUserRelationDetailsRequest;

class UserRelationController extends Controller
{
    public function __construct(protected  UserRelationService $UserRelationService) {}
    public function index()
    {
        return $this->UserRelationService->index()->response();
    }
    public function show(FetchUserRelationDetailsRequest $request)
    {
        return $this->UserRelationService->show($request)->response();
    }
    public function store(StoreUserRelationRequest $request)
    {
        return $this->UserRelationService->store($request->validated())->response();
    }
    public function update(UpdateUserRelationRequest $request)
    {
        return $this->UserRelationService->update($request->validated())->response();
    }
    public function delete(DeleteUserRelationRequest $request)
    {
        return $this->UserRelationService->delete($request)->response();
    }
}
