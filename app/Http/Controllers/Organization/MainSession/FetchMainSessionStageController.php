<?php

namespace App\Http\Controllers\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MainSession\FetchSessionBySurahRequest;
use App\Http\Requests\MainSession\FetchMainSessionStageRequest;
use App\Http\Requests\MainSession\FetchSessionAyahBySurahRequest;
use App\Http\Requests\MainSession\FetchSessionSurahBySessionRequest;
use App\Http\Requests\Organization\MainSession\FetchMainSessionRequest;
use App\Http\Requests\Organization\MainSession\FetchAdminSessionRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionService;
use App\Http\Requests\Organization\MainSession\FetchAdminSessionDetailRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionStageService;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionSurahAndAyahService;

class FetchMainSessionStageController extends Controller
{
    public function __construct(protected FetchMainSessionStageService $fetchMainSessionStageService) {}

    public function fetchMainSessionStage(FetchMainSessionStageRequest $request)
    {
        return $this->fetchMainSessionStageService->fetchMainSessionStage($request)->response();
    }
}
