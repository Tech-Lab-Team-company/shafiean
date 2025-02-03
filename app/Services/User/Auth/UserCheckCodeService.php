<?php

namespace App\Services\User\Auth;

use Exception;
use App\Trait\UserAuthentication;
use App\Helpers\Response\DataFailed;
use App\Services\Global\CodeService;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\UserWithOutTokenResource;

class UserCheckCodeService
{
    use UserAuthentication;
    const MODEL = "App\\Models\\User";

    public function checkCode($dataRequest)
    {
        try {
            $user = $this->getRow($dataRequest['email'], self::MODEL);
            (new CodeService())->checkCode($dataRequest, $user);
            return new DataSuccess(
                status: true,
                data: new UserWithOutTokenResource($user),
                message: __('messages.success_verify_code'),
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
