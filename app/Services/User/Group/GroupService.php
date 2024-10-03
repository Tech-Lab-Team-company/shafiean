<?php

namespace App\Services\User\Group;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Services\Global\FilterService;

class GroupService
{
    public function fetch_groups($request): DataStatus
    {
        try {
            $query = Group::query();
            if ($request) {
                $filter_service = new FilterService();
                $filter_service->filterGroup($request, $query);
            }
            $groups = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                status: true,
                data: GroupResource::collection($groups)->response()->getData(true),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
