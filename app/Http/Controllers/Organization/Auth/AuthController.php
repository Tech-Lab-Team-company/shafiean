<?php
namespace App\Http\Controllers\Organization\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Global\CheckCodeRequest;
use App\Http\Requests\Global\CheckEmailRequest;
use App\Services\Organization\Auth\AuthService;
use App\Http\Requests\Global\ResetPasswordRequest;
use App\Http\Requests\Global\ChangePasswordRequest;
use App\Http\Requests\Auth\OrganizationLoginRequest;

class AuthController extends Controller
{
    protected $auth_service;

    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function login(OrganizationLoginRequest $request)
    {
        return $this->auth_service->login($request)->response();
    }

    public function logout()
    {
        return $this->auth_service->logout()->response();
    }

    public function checkEmail(CheckEmailRequest $request)
    {
        return $this->auth_service->checkEmail($request)->response();
    }
    public function checkCode(CheckCodeRequest $request)
    {
        return $this->auth_service->checkCode($request)->response();
    }

    public function resetPassword(ResetPasswordRequest $request){

        return $this->auth_service->resetPassword($request)->response();
    }

    public function changePassword(ChangePasswordRequest $request){

        return $this->auth_service->changePassword($request)->response();
    }
}
