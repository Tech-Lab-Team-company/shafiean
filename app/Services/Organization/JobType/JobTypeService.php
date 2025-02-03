<?php

namespace App\Services\Organization\JobType;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\JobType\JobType;
use App\Http\Resources\Organization\JobType\JobTypeResource;
use App\Http\Resources\Organization\Relation\RelationResource;

class JobTypeService
{
    public function index()
    {
        try {
            $jobTypes = JobType::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: JobTypeResource::collection($jobTypes)->response()->getData(true),
                status: true,
                message: 'JobTypes fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function show($request)
    {
        $jobType = JobType::whereId($request->id)->first();
        return new DataSuccess(
            data: new JobTypeResource($jobType),
            statusCode: 200,
            message: 'Fetch JobType successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $jobType = JobType::create($dataRequest);
            return new DataSuccess(
                data: new JobTypeResource($jobType),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $jobType = JobType::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $jobType->update($dataRequest);
            return new DataSuccess(
                data: new JobTypeResource($jobType),
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($request): DataStatus
    {
        try {
            JobType::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'JobType deletion failed: ' . $e->getMessage()
            );
        }
    }
}
