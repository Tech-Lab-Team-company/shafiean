<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainSession\AddSessionRequest;
use App\Http\Requests\MainSession\ChangeSessionActiveStatusRequest;
use App\Http\Requests\MainSession\DeleteSessionRequest;
use App\Http\Requests\MainSession\EditSessionRequest;
use App\Http\Requests\MainSession\FetchSessionDetailsRequest;
use App\Http\Requests\MainSession\FetchSessionsRequest;
use App\Services\MainSessionService;
use Illuminate\Http\Request;

class MainSessionController extends Controller
{
    protected $main_session_service;

    public function __construct(MainSessionService $main_session_service)
    {
        $this->main_session_service = $main_session_service;
    }

    public function index(FetchSessionsRequest $request)
    {
        return $this->main_session_service->getAll($request)->response();
    }

    public function store(AddSessionRequest $request)
    {
        return $this->main_session_service->create($request)->response();
    }

    public function show(FetchSessionDetailsRequest $request)
    {
        return $this->main_session_service->getDetails($request)->response();
    }

    public function update(EditSessionRequest $request){
        return $this->main_session_service->update($request)->response();
    }

    public function destroy(DeleteSessionRequest $request){
        return $this->main_session_service->delete($request)->response();
    }

    public function changeActiveStatus(ChangeSessionActiveStatusRequest $request){
        return $this->main_session_service->changeActiveStatus($request)->response();
    }
}
