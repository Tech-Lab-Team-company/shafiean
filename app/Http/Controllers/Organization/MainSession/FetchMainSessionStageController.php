<?php

namespace App\Http\Controllers\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MainSession\FetchMainSessionStageRequest;
use App\Services\Organization\EndPoint\MainSession\FetchMainSessionStageService;

class FetchMainSessionStageController extends Controller
{
    public function __construct(protected FetchMainSessionStageService $fetchMainSessionStageService) {}

    public function fetchMainSessionStage(FetchMainSessionStageRequest $request)
    {
        return $this->fetchMainSessionStageService->fetchMainSessionStage($request)->response();
    }
}
