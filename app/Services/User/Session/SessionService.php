<?php

namespace App\Services\User\Session;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\MainSessionResource;
use App\Models\GroupStageSession;
use App\Models\MainSession;
use App\Services\Global\FilterService;

class SessionService
{
    public function fetch_sessions($request): DataStatus
    {
        try {
            $query = GroupStageSession::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterSessions($request, $query);
            }

            $sessions = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: MainSessionResource::collection($sessions)->response()->getData(true),
                status: true,
                message: 'Sessions fetched successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
