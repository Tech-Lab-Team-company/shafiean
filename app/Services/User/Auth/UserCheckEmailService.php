<?php

namespace App\Services\User\Auth;

use Exception;
use App\Trait\UserAuthentication;
use App\Helpers\Response\DataFailed;
use App\Services\Global\CodeService;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\EmailService;
use App\Http\Resources\User\UserWithOutTokenResource;

class UserCheckEmailService
{
    use UserAuthentication;
    const MODEL = "App\\Models\\User";

    public function checkEmail($dataRequest)
    {
        try {
            $user = $this->getRow($dataRequest['email'], self::MODEL);
            $email_service = new EmailService();
            $response = $email_service->checkEmail($user)->response()->getData();
            return new DataSuccess(
                status: true,
                data: true,
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
