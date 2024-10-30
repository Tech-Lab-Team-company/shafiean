<?php

namespace App\Services\Organization\EndPoint\MainSession;


use Exception;
use App\Models\MainSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Models\Organization\LibraryCategory\LibraryCategory;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;

class FetchMainSessionService
{
    public function fetchMainSessions($dataRequest)
    {
        try {
            $groupStageSessions = GroupStageSession::where('group_id', $dataRequest->group_id)->orderBy('id', 'desc')->paginate(10);
            // $mainSessions = MainSession::whereIn("id", $groupStageSessions)->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: FetchMainSessionResource::collection($groupStageSessions)->response()->getData(true),
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
