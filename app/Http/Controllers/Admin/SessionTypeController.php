<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SessionType\AddSessionTypeRequest;
use App\Http\Requests\SessionType\ChangeSessionTypeActiveStatusRequest;
use App\Http\Requests\SessionType\DeleteSessionTypeRequest;
use App\Http\Requests\SessionType\EditSessionTypeRequest;
use App\Http\Requests\SessionType\FetchSessionTypeDetailsRequest;
use App\Http\Requests\SessionType\FetchSessionTypesRequest;
use App\Services\SessionTypeService;
use Illuminate\Http\Request;

class SessionTypeController extends Controller
{
    protected $session_type_service;
    public function __construct(SessionTypeService $session_type_service)
    {
        $this->session_type_service = $session_type_service;
    }

    public function index(FetchSessionTypesRequest $request)
    {
        return $this->session_type_service->getAll($request)->response();
    }

    public function store(AddSessionTypeRequest $request){

        return $this->session_type_service->create($request)->response();
    }

    public function show(FetchSessionTypeDetailsRequest $request){

        return $this->session_type_service->getDetails($request)->response();
    }

    public function update (EditSessionTypeRequest $request){

        return $this->session_type_service->update($request)->response();
    }

    public function destroy(DeleteSessionTypeRequest $request){

        return $this->session_type_service->delete($request)->response();
    }

    public function changeActiveStatus(ChangeSessionTypeActiveStatusRequest $request){

        return $this->session_type_service->changeActiveStatus($request)->response();
    }
}
