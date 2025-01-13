<?php

namespace App\Http\Controllers\Organization\MainSession;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Organization\MainSession\MainSessionService;
use App\Http\Requests\Organization\MainSession\AddSessionRequest;
use App\Http\Requests\Organization\MainSession\EditSessionRequest;
use App\Http\Requests\Organization\MainSession\DeleteSessionRequest;
use App\Http\Requests\Organization\MainSession\FetchSessionsRequest;
use App\Services\Organization\MainSession\SortGroupStageSessionService;
use App\Http\Requests\Organization\MainSession\FetchSessionDetailsRequest;
use App\Http\Requests\Organization\MainSession\MainSessionIndexForGroupRequest;
use App\Http\Requests\Organization\MainSession\ChangeSessionActiveStatusRequest;

class SortGroupStageSessionController extends Controller
{

    public function __construct(protected SortGroupStageSessionService $sortGroupStageSessionService) {}

    public function sort(Request $request)
    {
        return $this->sortGroupStageSessionService->sort($request)->response();
    }
}
