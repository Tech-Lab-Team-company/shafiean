<?php

namespace App\Services\Organization\EndPoint\MainSession;

use Exception;
use App\Models\Ayah;
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
use App\Models\Organization\Library\Library;
use App\Http\Resources\Surah\AyahTitleResource;
use App\Http\Resources\Surah\SurahTitleResource;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Models\Organization\LibraryCategory\LibraryCategory;
use App\Http\Resources\Organization\MainSession\SessionAyahResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Organization\MainSession\FetchAdminSessionResource;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;

class FetchMainSessionSurahAndAyahService
{
    public function fetchSurahBySession($dataRequest)
    {
        try {
            $surah = MainSession::whereId($dataRequest->session_id)->first()->surah;
            return new DataSuccess(
                data: new SurahTitleResource($surah),
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
    public function fetchAyahBySurah($dataRequest)
    {
        try {
            $ayah = $dataRequest->is_new == SessionIsNewEnum::NEW->value ?
                Surah::whereId($dataRequest->surah_id)->first()->ayahs
                : MainSession::whereId($dataRequest->session_id)->first();
            return new DataSuccess(
                data: $dataRequest->is_new == SessionIsNewEnum::NEW->value ? AyahTitleResource::collection($ayah) : new SessionAyahResource($ayah),
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
