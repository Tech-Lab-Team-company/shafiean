<?php

namespace App\Services\User\Session;

use App\Models\MainSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\MainSessionResource;
use App\Http\Resources\Parent\Session\FetchChildSessionResource;
use App\Http\Resources\User\EndPoint\MainSession\FetchUserSessionResource;

class SessionService
{
    public function fetch_sessions($request, $student_id = null): DataStatus
    {
        try {
            $query = GroupStageSession::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterSessions($request, $query, $student_id);
            }

            $sessions = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: isset($request->with_parent) ? FetchChildSessionResource::collection($sessions)->response()->getData(true) : FetchUserSessionResource::collection($sessions)->response()->getData(true),
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
