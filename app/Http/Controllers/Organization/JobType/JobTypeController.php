<?php

namespace App\Http\Controllers\Organization\JobType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\JobType\JobTypeService;
use App\Http\Requests\Organization\JobType\StoreJobTypeRequest;
use App\Http\Requests\Organization\JobType\DeleteJobTypeRequest;
use App\Http\Requests\Organization\JobType\UpdateJobTypeRequest;
use App\Http\Requests\Organization\JobType\FetchJobTypeDetailsRequest;

class JobTypeController extends Controller
{
    public function __construct(protected  JobTypeService $jobTypeService) {}
    public function index()
    {
        return $this->jobTypeService->index()->response();
    }
    public function show(FetchJobTypeDetailsRequest $request)
    {
        return $this->jobTypeService->show($request)->response();
    }
    public function store(StoreJobTypeRequest $request)
    {
        return $this->jobTypeService->store($request->validated())->response();
    }
    public function update(UpdateJobTypeRequest $request)
    {
        return $this->jobTypeService->update($request->validated())->response();
    }
    public function delete(DeleteJobTypeRequest $request)
    {
        return $this->jobTypeService->delete($request)->response();
    }
}
