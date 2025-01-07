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

    public function fetch_session(FetchMainSessionRequest $request)
    {
        return $this->fetchMainSessionService->fetchSessions($request)->response();
    }
    public function fetch_main_session(FetchAdminSessionRequest $request)
    {
        // dd($request->all());
        return $this->fetchMainSessionService->fetchMainSessions($request)->response();
    }
    public function fetchMainSessionsForSession()
    {
        return $this->fetchMainSessionService->fetchMainSessionsForSession()->response();
    }
    public function fetch_main_session_detail(FetchAdminSessionDetailRequest $request)
    {
        // dd($request->all());
        return $this->fetchMainSessionService->fetchMainSessionsDetail($request)->response();
    }
}
