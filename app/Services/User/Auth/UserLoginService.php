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
            // $user = $this->getRow($dataRequest['email'], self::MODEL);
            $email = null;
            if(filter_var($dataRequest['email'], FILTER_VALIDATE_EMAIL)){
                $email = $dataRequest['email'];
            }else{
                $email = $this->getRow($dataRequest['email'], self::MODEL)->email;
            }
            $user = $this->getRow($email, self::MODEL);

            // $this->checkVerified($user);
            $this->validatePassword($dataRequest['password'], $user);
            $token = $this->generateSanctumToken($user);
            return new DataSuccess(
                status: true,
                data: (new UserLoginResource($user))->additional(['token' => $token]),
                message: __('messages.success_login'),
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
