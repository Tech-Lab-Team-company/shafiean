<?php

namespace App\Http\Controllers\Global;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Live\JoinRoomRequest;
use App\Http\Requests\Live\CreateRoomRequest;
use App\Services\Global\Live100MSIntegrationService;

class Live100MSIntegrationController extends Controller
{
    protected $live100MSIntegrationService;

    public function __construct(Live100MSIntegrationService $live100MSIntegrationService)
    {

        $this->live100MSIntegrationService = $live100MSIntegrationService;
    }

    public function create_room(CreateRoomRequest $request)
    {
        // dd($request->all());
        return $this->live100MSIntegrationService->create_room($request)->response();
    }
    public function join_room(JoinRoomRequest $request)
    {
        // dd($request->all());
        return $this->live100MSIntegrationService->join_room($request)->response();
    }
}
