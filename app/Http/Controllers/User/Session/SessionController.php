<?php

namespace App\Http\Controllers\User\Session;

use App\Http\Controllers\Controller;
use App\Services\User\Session\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    protected $session_service;
    public function __construct(SessionService $session_service)
    {
        $this->session_service = $session_service;
    }

    public function fetch_child_sessions(Request $request)
    {

        return $this->session_service->fetch_sessions($request, auth()->guard('user')->user()->id)->response();
    }

    public function fetch_student_sessions(Request $request)
    {

        return $this->session_service->fetch_sessions($request, $request->student_id)->response();
    }
}
