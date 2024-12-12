<?php

namespace App\Http\Controllers\Organization\Surah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Surah\SurahService;
use App\Http\Requests\organization\Surah\FetchSurahRequest;

class SurahController extends Controller
{
    public function __construct(protected SurahService $surahService) {}
    public function fetchSurahs()
    {
        return $this->surahService->fetchSurahs()->response();
    }
    public function fetchSurahAyahs(Request $request)
    {
        return $this->surahService->fetchSurahAyahs($request)->response();
    }
    public function fetchStageSurahs(Request $request)
    {
        return $this->surahService->fetchStageSurahs($request)->response();
    }
}
