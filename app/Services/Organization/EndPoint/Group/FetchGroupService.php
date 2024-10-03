<?php

namespace App\Services\Organization\EndPoint\Group;

use Exception;
use App\Models\Group;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\EndPoint\Group\FetchGroupResource;

class FetchGroupService
{
    public function fetchGroups()
    {
        try {
            $groups = Group::get();
            return new DataSuccess(
                data: FetchGroupResource::collection($groups),
                status: true,
                message: 'Fetch Groups successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
