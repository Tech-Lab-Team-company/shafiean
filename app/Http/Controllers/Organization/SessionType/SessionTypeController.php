<?php

namespace App\Http\Controllers\Organization\SessionType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\SessionType\SessionTypeService;

class SessionTypeController extends Controller
{

    function __construct(protected SessionTypeService $sessionTypeService) {}
    function fetchSessionTypes()
    {
        return $this->sessionTypeService->sessionType()->response();
    }
}
