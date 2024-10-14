<?php

namespace App\Services\Organization\Landingpage\EndPoint\SubHeader;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Subheader;
use App\Http\Resources\Organization\Landingpage\EndPoint\SubHeader\FetchSubHeaderResource;

class FetchSubHeaderService
{
    public function fetchsubHeaders()
    {
        try {
            $subHeaders  = Subheader::get();
            return new DataSuccess(
                data: FetchSubHeaderResource::collection($subHeaders),
                status: true,
                message: 'Fetch Sub Headers successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
