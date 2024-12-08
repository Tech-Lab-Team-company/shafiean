<?php

namespace App\Http\Controllers\Organization\Surah;

use App\Models\Ayah;
use App\Models\Ayat;
use App\Models\Surah\Surah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\ApiMethodsService;
use App\Services\Admin\SurahApiProvider\SurahApiProviderService;

class SurahApiProviderController extends Controller
{
    public function __construct(protected SurahApiProviderService $surahApiProviderService) {}
    public function fetchSurahApiProvider()
    {
        return $this->surahApiProviderService->store()->response();
        // $apiURL = 'https://api.alquran.cloud/v1/quran/ar.alafasy';
        // $headers = [
        //     'Content-Type' => 'application/json',
        //     'Accept' => 'application/json'
        // ];
        // $apiService = new ApiMethodsService();
        // $response = $apiService->withHeaders($headers)->getApiData($apiURL);
        // foreach ($response['data']['surahs'] as $surah) {
        //     $databaseSurah = Surah::firstOrCreate([
        //         'name' => $surah['name'],
        //         'number' => $surah['number'],
        //         'revelation_type' => $surah['revelationType'],
        //     ]);
        //     $ayahs = collect($surah['ayahs']);
        //     foreach ($ayahs as $ayah) {
        //         Ayah::firstOrCreate([
        //             'surah_id' => $databaseSurah->id,
        //             'text' => $ayah['text'],
        //             'number' => $ayah['number'],
        //             'juz' => $ayah['juz'],
        //             'page' => $ayah['page'],
        //             'number_in_surah' => $ayah['numberInSurah'],
        //             'audio' => $ayah['audio'],
        //         ]);
        //     }
        // }
        // return 'done';
    }
}
