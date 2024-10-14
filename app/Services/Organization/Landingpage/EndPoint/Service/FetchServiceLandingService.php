<?php
namespace App\Services\Organization\Landingpage\EndPoint\Service;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Service;
use App\Http\Resources\Organization\Landingpage\EndPoint\Service\FetchServiceResource;

class FetchServiceLandingService
{
    public function fetchServices()
    {
        try {
            $services  = Service::get();
            return new DataSuccess(
                data: FetchServiceResource::collection($services),
                status: true,
                message: 'Fetch Services successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
