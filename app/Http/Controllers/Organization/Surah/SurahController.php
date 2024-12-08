<?php

namespace App\Http\Controllers\Organization\Surah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Surah\SurahService;

class SurahController extends Controller
{
    public function __construct(protected SurahService $surahService) {}
    public function fetchSurahs()
    {
        return $this->surahService->fetchSurahs()->response();
    }
}
