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
use App\Http\Requests\Organization\MainSession\FetchSessionDetailsRequest;
use App\Http\Requests\Organization\MainSession\MainSessionIndexForGroupRequest;
use App\Http\Requests\Organization\MainSession\ChangeSessionActiveStatusRequest;

class MainSessionController extends Controller
{

    public function __construct(protected MainSessionService $mainSessionService) {}

    public function index(MainSessionIndexForGroupRequest $request)
    {
        return $this->mainSessionService->index($request)->response();
    }

    public function store(AddSessionRequest $request)
    {
        return $this->mainSessionService->create($request)->response();
    }

    public function show(FetchSessionDetailsRequest $request)
    {
        return $this->mainSessionService->getDetails($request)->response();
    }

    public function update(EditSessionRequest $request)
    {
        return $this->mainSessionService->update($request)->response();
    }

    public function destroy(DeleteSessionRequest $request)
    {
        return $this->mainSessionService->delete($request)->response();
    }

    public function changeActiveStatus(ChangeSessionActiveStatusRequest $request)
    {
        return $this->mainSessionService->changeActiveStatus($request)->response();
    }
}
