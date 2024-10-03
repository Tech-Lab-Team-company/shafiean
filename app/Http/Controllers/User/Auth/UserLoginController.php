<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserLoginService;
use App\Http\Requests\User\Auth\UserLoginRequest;
use App\Http\Requests\User\Auth\UserRegisterRequest;

class UserLoginController extends Controller
{
    public function __construct(protected UserLoginService $userLoginService) {}
    public function __invoke(UserLoginRequest $request)
    {
        return $this->userLoginService->login($request)->response();
    }
}
