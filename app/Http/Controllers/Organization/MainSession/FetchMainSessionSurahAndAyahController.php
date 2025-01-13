<?php

namespace App\Http\Controllers\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainSession\FetchSessionBySurahRequest;
use App\Http\Requests\MainSession\FetchSessionAyahBySurahRequest;
use App\Http\Requests\MainSession\FetchSessionSurahBySessionRequest;
use App\Http\Requests\Organization\MainSession\FetchMainSessionRequest;
use App\Http\Requests\Organization\MainSession\FetchAdminSessionRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionService;
use App\Http\Requests\Organization\MainSession\FetchAdminSessionDetailRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionSurahAndAyahService;

class FetchMainSessionSurahAndAyahController extends Controller
{
    public function __construct(protected FetchMainSessionSurahAndAyahService $fetchMainSessionSurahAndAyahService) {}

    public function fetchSurahBySession(FetchSessionSurahBySessionRequest $request)
    {
        return $this->fetchMainSessionSurahAndAyahService->fetchSurahBySession($request)->response();
    }
    public function fetchAyahBySurah(FetchSessionAyahBySurahRequest $request)
    {
        return $this->fetchMainSessionSurahAndAyahService->fetchAyahBySurah($request)->response();
    }
    public function fetchAyahForSession(Request $request)
    {
        return $this->fetchMainSessionSurahAndAyahService->fetchAyahForSession( $request)->response();
    }
}
