<?php

namespace App\Services\User\Auth;

use Exception;
use App\Models\User;
use App\Helpers\Response\DataFailed;
use App\Http\Resources\UserResource;
use App\Helpers\Response\DataSuccess;
use App\Notifications\EmailNotification;
use App\Http\Resources\User\Auth\UserRegisterResource;

class UserRegisterService
{
    public function register($dataRequest)
    {
        try {
            $organizationId = checkWebsiteLink($dataRequest);

            $user = User::create([
                'name' => $dataRequest['name'],
                'email' => $dataRequest['email'],
                'password' => $dataRequest['password'],
                'phone' => $dataRequest['phone'],
                'date_of_birth' => $dataRequest['date_of_birth'],
                'address' => $dataRequest['address'],
                'gender' => $dataRequest['gender'],
                'type' => $dataRequest['type'],
                'country_id' => $dataRequest['country_id'],
                'blood_type_id' => $dataRequest['blood_type_id'],
                'identity_type' => $dataRequest['identity_type'],
                'identity_number' => $dataRequest['identity_number'],
                'image' => $dataRequest['image'] ? upload_image($dataRequest['image'], 'users') : null,
                'organization_id' => $organizationId,
            ]);
            // $user->notify(new EmailNotification());

            return new DataSuccess(
                status: true,
                // data: new UserRegisterResource($user),
                message: 'user Registered successfully,please verify your email',
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
