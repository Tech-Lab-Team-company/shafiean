<?php

namespace App\Services\User\Auth;

use Exception;
use App\Trait\UserAuthentication;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\Auth\UserLoginResource;
use App\Http\Resources\User\UserWithOutTokenResource;

class UserChangePasswordService
{
    use UserAuthentication;
    const MODEL = "App\\Models\\User";

    public function changePassword($dataRequest)
    {
        try {
            $user = $this->getRow($dataRequest['email'], self::MODEL);
            // $this->checkVerified($user);
            $this->validatePassword($dataRequest['old_password'], $user);
            $user->update([
                'password' => $dataRequest->new_password
            ]);
            return new DataSuccess(
                status: true,
                data: new UserWithOutTokenResource($user),
                message: 'Change password successfully',
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
