<?php

namespace App\Services\Organization\EndPoint\MainSession;


use Exception;
use App\Models\MainSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Models\Organization\LibraryCategory\LibraryCategory;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;
use App\Http\Resources\Organization\MainSession\FetchAdminSessionResource;

class FetchMainSessionService
{
    public function fetchSessions($dataRequest)
    {
        try {
            $groupStageSessions = GroupStageSession::where('group_id', $dataRequest->group_id)->orderBy('id', 'desc')->get();
            // $mainSessions = MainSession::whereIn("id", $groupStageSessions)->orderBy('id', 'desc')->paginate(10);
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
            // $groupStageSessions = GroupStageSession::where('group_id', $dataRequest->group_id)->orderBy('id', 'desc')->get();
            $query = MainSession::whereNull('organization_id');

            if (isset($dataRequest) && $dataRequest != null) {
                $filter_servise = new FilterService();
                $filter_servise->filterMainSession($dataRequest, $query);
            }
            $mainSessions = $query->orderBy('id', 'desc')->paginate(10);
            // dd($mainSessions);
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
    public function fetchMainSessionsDetail($dataRequest)
    {
        try {
            // $groupStageSessions = GroupStageSession::where('group_id', $dataRequest->group_id)->orderBy('id', 'desc')->get();
            $main_session = MainSession::where('id', $dataRequest->session_id)->first();
            // dd($mainSessions);
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
