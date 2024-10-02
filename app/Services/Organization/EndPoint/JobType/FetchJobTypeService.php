<?php

namespace App\Services\Organization\EndPoint\JobType;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\JobType\JobType;
use App\Http\Resources\Organization\EndPoint\JobType\FetchJobTypeResource;

class FetchJobTypeService
{
    public function fetchJobTypes()
    {
        try {
            $jobTypes = JobType::get();
            return new DataSuccess(
                data: FetchJobTypeResource::collection($jobTypes),
                status: true,
                message: 'Fetch JobType successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
