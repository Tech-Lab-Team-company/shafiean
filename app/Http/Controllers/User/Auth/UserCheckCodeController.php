<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserCheckPasswordService;
use App\Http\Requests\User\Auth\UserCheckCodeRequest;

class UserCheckCodeController extends Controller
{
    public function __construct(protected UserCheckPasswordService $userCheckPasswordService) {}

    public function __invoke(UserCheckCodeRequest $request)
    {
        return $this->userCheckPasswordService->checkCode($request);
    }
}
