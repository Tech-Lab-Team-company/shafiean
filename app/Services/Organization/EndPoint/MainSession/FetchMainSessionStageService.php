<?php

namespace App\Services\Organization\EndPoint\MainSession;

use Exception;
use App\Models\Ayah;
use App\Models\Course;
use App\Models\MainSession;
use App\Models\Surah\Surah;
use App\Enum\SessionIsNewEnum;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\StageTitleResource;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Surah\AyahTitleResource;
use App\Http\Resources\Surah\SurahTitleResource;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Models\Organization\LibraryCategory\LibraryCategory;
use App\Http\Resources\Organization\MainSession\SessionAyahResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Organization\MainSession\FetchAdminSessionResource;
use App\Http\Resources\Organization\MainSession\SessionStageTitleResource;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;

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
