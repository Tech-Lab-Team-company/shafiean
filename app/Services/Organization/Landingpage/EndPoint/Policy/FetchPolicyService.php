<?php

namespace App\Services\Organization\Landingpage\EndPoint\Policy;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Policy;
use App\Http\Resources\Organization\Landingpage\EndPoint\Policy\FetchPolicyResource;

class FetchPolicyService
{
    public function fetchPolicy()
    {
        try {
            $policy  = Policy::first();
            return new DataSuccess(
                data: new FetchPolicyResource($policy),
                status: true,
                message: 'Fetch Policy successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
