<?php

namespace App\Http\Controllers\Organization\MainSession;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MainSession\SortGroupStageSessionRequest;
use App\Services\Organization\MainSession\SortGroupStageSessionService;

class SortGroupStageSessionController extends Controller
{

    public function __construct(protected SortGroupStageSessionService $sortGroupStageSessionService) {}

    public function sort(SortGroupStageSessionRequest $request)
    {
        return $this->sortGroupStageSessionService->sort($request)->response();
    }
}
