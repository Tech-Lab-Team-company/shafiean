<?php

namespace App\Http\Controllers\User\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserChangePasswordService;
use App\Http\Requests\User\Auth\UserChangePasswordRequest;

class UserChangePasswordController  extends Controller
{
    public function __construct(protected UserChangePasswordService $userChangePasswordService) {}

    public function __invoke(UserChangePasswordRequest $request)
    {
        return $this->userChangePasswordService->changePassword($request)->response();
    }
}
