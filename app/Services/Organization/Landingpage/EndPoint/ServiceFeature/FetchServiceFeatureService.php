<?php

namespace App\Services\Organization\Landingpage\EndPoint\ServiceFeature;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\ServiceFeature;
use App\Http\Resources\Organization\Landingpage\EndPoint\Service\FetchServiceResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\ServiceFeature\FetchServiceFeatureResource;

class FetchServiceFeatureService
{
    public function fetchServiceFeatures()
    {
        try {
            $serviceFeatures  = ServiceFeature::get();
            return new DataSuccess(
                data: FetchServiceFeatureResource::collection($serviceFeatures),
                status: true,
                message: 'Fetch Service Features successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
