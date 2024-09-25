<?php

namespace App\Http\Controllers\Organization\TeacherAuth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Services\Organization\TeacherAuth\TeacherAuthService;

class TeacherAuthController extends Controller
{
    protected $teacherAuthService;

    public function __construct(TeacherAuthService $teacherAuthService)
    {
        $this->teacherAuthService = $teacherAuthService;
    }

    public function login(AuthRequest $request)
    {
        return $this->teacherAuthService->login($request)->response();
    }

    public function logout(Request $request)
    {
        return $this->teacherAuthService->logout()->response();
    }
}
