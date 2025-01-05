<?php

namespace App\Services\Admin\SurahApiProvider;

use Exception;
use App\Models\Ayah;
use App\Models\Surah\Surah;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Services\Api\ApiMethodsService;
use App\Http\Resources\Surah\SurahResource;

class SurahApiProviderService
{
    private string $apiURL = 'https://api.alquran.cloud/v1/quran/ar.alafasy';
    private  $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];
    public function store()
    {
        try {
            $apiData = $this->getApiData();
            if (!isset($apiData['status']) || $apiData['status'] !== 200) {
                return new DataSuccess(
                    status: false,
                    message: "No connection to server | لايوجد اتصال بالخادم",
                );
            }
            $surahs = [];
            foreach ($apiData['data']['surahs'] as $surah) {
                $databaseSurah = Surah::firstOrCreate([
                    'name' => $surah['name'],
                    'number' => $surah['number'],
                    'revelation_type' => $surah['revelationType'],
                ]);
                $surahs[] = $databaseSurah;
                $ayahs = collect($surah['ayahs']);
                foreach ($ayahs as $ayah) {
                    Ayah::firstOrCreate([
                        'surah_id' => $databaseSurah->id,
                        'text' => $ayah['text'],
                        'number' => $ayah['number'],
                        'juz' => $ayah['juz'],
                        'page' => $ayah['page'],
                        'number_in_surah' => $ayah['numberInSurah'],
                        'audio' => $ayah['audio'],
                    ]);
                }
            }
            return new DataSuccess(
                data: SurahResource::collection($surahs),
                status: true,
                message: 'Surahs fetched and store in DB successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    private function getApiData()
    {
        return (new ApiMethodsService())->withHeaders($this->headers)->getApiData($this->apiURL);
    }
}
