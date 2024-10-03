<?php

namespace App\Services\User\Auth;

use Exception;
use App\Trait\UserAuthentication;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\Auth\UserLoginResource;

class UserLoginService
{
    use UserAuthentication;
    const MODEL = "App\\Models\\User";

    public function login($dataRequest)
    {
        try {
            $user = $this->getRow($dataRequest['email'], self::MODEL);
            $this->checkVerified($user);
            $this->validatePassword($dataRequest['password'], $user);
            $token = $this->generateSanctumToken($user);
            return new DataSuccess(
                status: true,
                data: (new UserLoginResource($user))->additional(['token' => $token]),
                message: 'Login successfully',
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
