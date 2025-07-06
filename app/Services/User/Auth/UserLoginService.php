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
            $dataRequest = $dataRequest->all();
            // $user = $this->getRow($dataRequest['email'], self::MODEL);
            $email = null;
            $user = null;
            if(array_key_exists('credential', $dataRequest) && filter_var($dataRequest['credential'], FILTER_VALIDATE_EMAIL)){
                $email = $dataRequest['credential'];
                $user = $this->getRow($email, self::MODEL);
            }elseif(array_key_exists('email', $dataRequest)){
                $email = $dataRequest['email'];
                $user = $this->getRow($email, self::MODEL);
            }

            
            dd($user);

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
