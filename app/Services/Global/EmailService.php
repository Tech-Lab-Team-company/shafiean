<?php

namespace App\Services\Global;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Admin\Admin;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;

class EmailService
{

    public function checkEmail($user = null): DataStatus
    {


        if ($user) {
            // If user exists, send an email verification notification
            $user->notify(new EmailNotification());
            // Return a DataSuccess status indicating successful email verification
            $msg = __('messages.check_email_verification');
            return new DataSuccess(
                status: true,
                data: true,
                message: $msg
            );
        } else {
            // If email is not found, return a DataFailed status with appropriate message and status code
            $msg = __('messages.email_not_found');
            return new DataFailed(
                message: $msg,
                status: false,
                statusCode: 401
            );
        }
    }
}