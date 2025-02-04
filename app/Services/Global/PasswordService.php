<?php

namespace App\Services\Global;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use Exception;
use Illuminate\Support\Facades\Hash;

class PasswordService
{

    public function resetPassword($request, $user): DataStatus
    {
        try {
            if (!$user) {
                return new DataSuccess(
                    status: false,
                    data: false,
                    message: __('messages.email_not_found')
                );
            }
            $verefied = $user->email_verified_at;
            // dd($verefied);
            if ($verefied == null) {
                // dd($verefied);
                return new DataSuccess(
                    status: false,
                    data: false,
                    message: __('messages.email_not_verified')
                );
            }
            $user->update([
                'password' => $request->password,
            ]);
            return new DataSuccess(
                status: true,
                message: __('messages.success_reset_password')
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function changePassword($request, $user): DataStatus
    {
        try {
            if (!Hash::check($request->old_password, $user->password)) {
                return new DataFailed(
                    status: false,
                    message: __('messages.current_password_incorrect')
                );
            }
            $user->update([
                'password' => $request->new_password
            ]);

            return new DataSuccess(
                status: true,
                message: __('messages.success_change_password')
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
