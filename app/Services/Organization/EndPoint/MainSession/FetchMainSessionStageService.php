<?php

namespace App\Services\Organization\EndPoint\MainSession;

use Exception;
use App\Models\Course;
use App\Models\MainSession;
use App\Enum\SessionIsNewEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\StageTitleResource;
use App\Http\Resources\Organization\MainSession\SessionStageTitleResource;

class FetchMainSessionStageService
{
    public function fetchMainSessionStage($dataRequest)
    {
        try {
            $isNew = $dataRequest->is_new == SessionIsNewEnum::NEW->value;
            $stage = $isNew ? Course::whereId($dataRequest->course_id)->first()->stages : MainSession::whereId($dataRequest->session_id)->first();
            return new DataSuccess(
                data: $isNew ? StageTitleResource::collection($stage) : [new SessionStageTitleResource($stage)],
                status: true,
                message: 'Surah Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
