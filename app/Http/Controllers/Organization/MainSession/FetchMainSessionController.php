<?php

namespace App\Http\Controllers\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\MainSession\FetchMainSessionRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionService;

class FetchMainSessionController extends Controller
{
    public function __construct(protected FetchMainSessionService $fetchMainSessionService) {}

    public function __invoke(FetchMainSessionRequest $request)
    {
        return $this->fetchMainSessionService->fetchMainSessions($request)->response();
    }
}
