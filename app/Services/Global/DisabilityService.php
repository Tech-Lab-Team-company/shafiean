<?php

namespace App\Services\Global;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\DisabilityTypeResource;
use App\Models\DisabilityType;
use Exception;

class DisabilityService
{

    public function fetach_disabilities(): DataStatus
    {
        try {
            $disabilities = DisabilityType::get();

            return new DataSuccess(
                status: true,
                data: DisabilityTypeResource::collection($disabilities),
                message: 'disabilities fetched successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
