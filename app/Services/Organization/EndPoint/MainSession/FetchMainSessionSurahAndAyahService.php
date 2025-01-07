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
            $surah = $dataRequest->session_id != null ? [MainSession::whereId($dataRequest->session_id)->first()->surah] : Surah::all();
            return new DataSuccess(
                data: SurahTitleResource::collection($surah),
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
    public function fetchSurahForSession()
    {
        try {
            $surah = Surah::all();
            return new DataSuccess(
                data: SurahTitleResource::collection($surah),
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
            $isNew = $dataRequest->is_new == SessionIsNewEnum::NEW->value;
            $ayah =  $isNew ?
                Surah::whereId($dataRequest->surah_id)->first()->ayahs
                : MainSession::whereId($dataRequest->session_id)->first();
            return new DataSuccess(
                data: $isNew ? AyahTitleResource::collection($ayah) : new SessionAyahResource($ayah),
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
    public function fetchAyahForSession()
    {
        try {
            $ayahs = Ayah::all();
            return new DataSuccess(
                data: AyahTitleResource::collection($ayahs),
                status: true,
                message: 'Ayah fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
