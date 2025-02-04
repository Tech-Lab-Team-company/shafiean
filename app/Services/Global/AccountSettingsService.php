<?php

namespace App\Services\Global;

use Exception;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AccountSettings\UserAccountSettingsResource;


class AccountSettingsService
{

    public function fetchAccountSettings($user)
    {
        try {
            return new DataSuccess(
                status: true,
                data: new UserAccountSettingsResource($user),
                message: __('messages.success')
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function updateAccountSettings($user, $dataRequest)
    {
        try {
            if ($dataRequest->hasFile('image')) {
                if ($user->image && file_exists($user->image)) {
                    delete_image($user->image);
                }
                $data['image'] = upload_image($dataRequest->file('image'), getCurrentGuard() == 'organization' ? 'Teachers' : 'users');
            }
            $data['name'] = $dataRequest->name ?? $user->name;
            $data['email'] = $dataRequest->email ?? $user->email;
            $data['phone'] = $dataRequest->phone ?? $user->phone;
            $user->update($data);
            return new DataSuccess(
                status: true,
                data: new UserAccountSettingsResource($user),
                message: __('messages.success_update')
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function changeAccountSettings($user, $dataRequest)
    {
        try {
            $response = (new PasswordService())->changePassword($dataRequest, $user)->response()->getData();
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
