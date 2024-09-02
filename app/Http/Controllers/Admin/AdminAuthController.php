<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\Global\ChangePasswordRequest;
use App\Http\Requests\Global\CheckCodeRequest;
use App\Http\Requests\Global\CheckEmailRequest;
use App\Http\Requests\Global\ResetPasswordRequest;
use App\Http\Resources\AdminResource;
use App\Services\AdminAuthService;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    protected $adminAuthService;
    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }
    public function login(AdminLoginRequest $request)
    {
        return $this->adminAuthService->login($request)->response();
    }
    public function logout()
    {
        return $this->adminAuthService->logout()->response();
    }

    public function changePassword(ChangePasswordRequest $request)
    {

        return $this->adminAuthService->changePassword($request)->response();
    }

    public function checkEmail(CheckEmailRequest $request)
    {
        return $this->adminAuthService->checkEmail($request)->response();
    }
    public function checkCode(CheckCodeRequest $request)
    {
        return $this->adminAuthService->checkCode($request)->response();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->adminAuthService->resetPassword($request)->response();
    }
}
