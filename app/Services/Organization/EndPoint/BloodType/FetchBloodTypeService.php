<?php

namespace App\Services\Organization\EndPoint\BloodType;

use Exception;
use App\Models\BloodType;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\EndPoint\BloodType\FetchBloodTypeResource;

class FetchBloodTypeService
{
    public function fetchBloodTypes()
    {
        try {
            $bloodTypes = BloodType::get();
            return new DataSuccess(
                data: FetchBloodTypeResource::collection($bloodTypes),
                status: true,
                message: 'Fetch BloodType successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
