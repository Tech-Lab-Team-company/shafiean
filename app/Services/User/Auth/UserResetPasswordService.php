<?php

namespace App\Services\User\Auth;

use Exception;
use App\Trait\UserAuthentication;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\Auth\UserLoginResource;
use App\Services\Global\PasswordService;

class UserResetPasswordService
{
    use UserAuthentication;
    const MODEL = "App\\Models\\User";

    public function resetPassword($dataRequest)
    {
        try {
            $user = $this->getRow($dataRequest['email'], self::MODEL);
            $password_service = new PasswordService();
            $response = $password_service->resetPassword($dataRequest, $user)->response()->getData();
            // $token =  $this->regenerateSanctumToken(row: $user);
            return new DataSuccess(
                status: true,
                message: $response->message
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
