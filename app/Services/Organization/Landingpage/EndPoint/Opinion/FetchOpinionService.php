<?php

namespace App\Services\Organization\Landingpage\EndPoint\Opinion;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Opinion;
use App\Models\Organization\Landingpage\ServiceFeature;
use App\Http\Resources\Organization\Landingpage\EndPoint\Opinion\FetchOpinionResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\Service\FetchServiceResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\ServiceFeature\FetchServiceFeatureResource;

class FetchOpinionService
{
    public function fetchOpinions()
    {
        try {
            $opinions  = Opinion::get();
            return new DataSuccess(
                data: FetchOpinionResource::collection($opinions),
                status: true,
                message: 'Fetch Opinions successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
