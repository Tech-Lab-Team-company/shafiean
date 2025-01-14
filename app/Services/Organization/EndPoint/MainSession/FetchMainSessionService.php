<?php

namespace App\Services\Organization\EndPoint\MainSession;

use Exception;
use App\Models\MainSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Organization\MainSession\FetchAdminSessionResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionForSessionResource;
use App\Models\CourseStage;

class FetchMainSessionService
{
    public function fetchSessions($dataRequest)
    {
        try {
            $groupStageSessions = GroupStageSession::where('group_id', $dataRequest->group_id)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: FetchMainSessionResource::collection($groupStageSessions),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchMainSessions($dataRequest)
    {
        try {
            $query = MainSession::whereNull('organization_id');
            if (isset($dataRequest) && $dataRequest != null) {
                $filter_servise = new FilterService();
                $filter_servise->filterMainSession($dataRequest, $query);
            }
            $mainSessions = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: FetchAdminSessionResource::collection($mainSessions)->response()->getData(),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchMainSessionsForSession($dataRequest)
    {
        try {
            $sessionIds = GroupStageSession::where('group_id', $dataRequest->group_id)
                ->pluck('session_id')
                ->filter()
                ->toArray();
            $mainSessions = CourseStage::where("course_id", $dataRequest->course_id)
                ->first()
                ->sessions()
                ->whereNotIn("main_sessions.id", $sessionIds)
                ->orderBy('id', 'desc')
                ->get();
            return new DataSuccess(
                data: FetchMainSessionForSessionResource::collection($mainSessions),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchAllSessions($dataRequest)
    {
        try {
            $mainSessions = CourseStage::where("course_id", $dataRequest->course_id)
                ->first()
                ->sessions()
                ->orderBy('id', 'desc')
                ->get();
            return new DataSuccess(
                data: FetchMainSessionForSessionResource::collection($mainSessions),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchMainSessionsDetail($dataRequest)
    {
        try {
            $main_session = MainSession::where('id', $dataRequest->session_id)->first();
            return new DataSuccess(
                data: new FetchAdminSessionResource($main_session),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
