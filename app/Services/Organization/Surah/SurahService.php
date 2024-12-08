<?php

namespace App\Services\Organization\Surah;

use Exception;
use App\Models\Surah\Surah;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Surah\SurahResource;
use App\Http\Resources\Surah\AyahTitleResource;
use App\Http\Resources\Surah\SurahTitleResource;

class SurahService
{
    public function fetchSurahs()
    {
        try {
            $surahs = Surah::all();
            return new DataSuccess(
                data: SurahTitleResource::collection($surahs),
                statusCode: 200,
                message: 'surah retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve surah: ' . $e->getMessage()
            );
        }
    }
    public function fetchSurahAyahs($dataRequest)
    {
        try {
            $surah = Surah::whereId($dataRequest->surah_id)?->first();
            $ayahs = $surah?->ayahs()?->get() ?? [];
            return new DataSuccess(
                data: AyahTitleResource::collection($ayahs),
                statusCode: 200,
                message: 'ayah retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve ayah: ' . $e->getMessage()
            );
        }
    }
}
