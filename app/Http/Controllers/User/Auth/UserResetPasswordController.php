<?php
namespace App\Http\Controllers\User\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserResetPasswordService;
use App\Http\Requests\User\Auth\UserResetPasswordRequest;

class UserResetPasswordController extends Controller
{
    public function __construct(protected UserResetPasswordService $userResetPasswordService) {}
    public function __invoke(UserResetPasswordRequest $request)
    {
        return $this->userResetPasswordService->resetPassword($request)->response();
    }
}
