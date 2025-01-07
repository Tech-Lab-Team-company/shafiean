<?php

namespace App\Services\Organization\SessionType;

use Exception;
use App\Models\SessionType;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\SessionTypeResource;
use App\Http\Resources\SessionTypeTitleResource;

class SessionTypeService
{
    public function sessionType()
    {
        try {
            $sessionTypes = SessionType::get();
            return new DataSuccess(
                data: SessionTypeTitleResource::collection($sessionTypes),
                status: true,
                message: 'SessionType fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
