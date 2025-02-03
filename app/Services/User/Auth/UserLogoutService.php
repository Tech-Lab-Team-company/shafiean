<?php

namespace App\Services\User\Auth;

use Exception;
use App\Trait\UserAuthentication;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;

class UserLogoutService
{
    use UserAuthentication;
    const GUARD = "user";

    public function logout()
    {
        try {
            $user = $this->getAuthenticatedUser(guard: self::GUARD);
            $this->removeCurrentSanctumToken(model: $user);
            return new DataSuccess(
                status: true,
                message: __('messages.success_logout'),
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
