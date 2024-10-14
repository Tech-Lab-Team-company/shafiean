<?php

namespace App\Services\Organization\Landingpage\EndPoint\Partner;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Partner;
use App\Http\Resources\Organization\Landingpage\EndPoint\Partner\FetchPartnerResource;

class FetchPartnerService
{
    public function fetchPartners()
    {
        try {
            $partners  = Partner::get();
            return new DataSuccess(
                data: FetchPartnerResource::collection($partners),
                status: true,
                message: 'Fetch Partners successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
