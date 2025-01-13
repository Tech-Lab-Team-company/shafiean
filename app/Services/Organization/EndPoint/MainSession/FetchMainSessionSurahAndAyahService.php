<?php

namespace App\Services\Organization\EndPoint\MainSession;

use Exception;
use App\Models\Ayah;
use App\Models\MainSession;
use App\Models\Surah\Surah;
use App\Enum\SessionIsNewEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Surah\AyahTitleResource;
use App\Http\Resources\Surah\SurahTitleResource;
use App\Http\Resources\Organization\MainSession\SessionAyahResource;

class FetchMainSessionSurahAndAyahService
{
    public function fetchSurahBySession($dataRequest)
    {
        try {
            $surah = $dataRequest->session_id != null ? [MainSession::whereId($dataRequest->session_id)->first()] : Surah::all();
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
    public function fetchAyahForSession($dataRequest)
    {
        try {
            $ayahs = $dataRequest->ayah_id != null ? [Ayah::whereId($dataRequest->ayah_id)->first()] : Ayah::all();
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
