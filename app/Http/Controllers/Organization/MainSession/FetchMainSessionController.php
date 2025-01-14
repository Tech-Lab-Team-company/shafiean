<?php

namespace App\Http\Controllers\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\MainSession\FetchMainSessionRequest;
use App\Http\Requests\Organization\MainSession\FetchAdminSessionRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionService;
use App\Http\Requests\Organization\MainSession\FetchAdminSessionDetailRequest;

class FetchMainSessionController extends Controller
{
    public function __construct(protected FetchMainSessionService $fetchMainSessionService) {}

    public function fetchSessions(FetchMainSessionRequest $request)
    {
        return $this->fetchMainSessionService->fetchSessions($request)->response();
    }
    public function fetchMainSessions(FetchAdminSessionRequest $request)
    {
        return $this->fetchMainSessionService->fetchMainSessions($request)->response();
    }
    public function fetchMainSessionsForSession(FetchMainSessionRequest $request)
    {
        return $this->fetchMainSessionService->fetchMainSessionsForSession($request)->response();
    }
    public function fetchAllSessions(FetchMainSessionRequest $request)
    {
        return $this->fetchMainSessionService->fetchAllSessions($request)->response();
    }
    public function fetchMainSessionsDetail(FetchAdminSessionDetailRequest $request)
    {
        return $this->fetchMainSessionService->fetchMainSessionsDetail($request)->response();
    }
}
