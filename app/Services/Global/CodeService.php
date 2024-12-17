<?php

namespace App\Services\Global;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use Ichtrojan\Otp\Otp;

class CodeService
{
    protected $otp; // The OTP (One-Time Password) instance used for validating codes.

    /**
     * Constructor method for the class.
     *
     * Initializes the $otp property with a new instance of Otp.
     *
     * @return void
     */
    public function __construct()
    {
        $this->otp = new Otp();
    }
    public function checkCode($request, $user): DataStatus
    {
        // Validate the provided code against the user's email
        $otp2 = $this->otp->validate($request->email, $request->code);

        if (!$otp2->status) {
            // If the code validation fails, return a DataFailed status with the appropriate message
            return new DataFailed(
                status: false,
                message: $otp2->message,
            );
        } else {
            // If the code validation is successful
            // Find the user by email and update their verification status and timestamp
            // $user = User::where('email', $request->email)->first();
            $user->update(['email_verified_at' => now()]);
            $msg = 'email verified successfully';
            // Return a DataSuccess status indicating successful verification
            return new DataSuccess(
                status: true,
                // data: UserResource::make($user),
                message: $msg
            );
        }
    }
    public function resetPasswordcheckCode($request, $user): DataStatus
    {
        $otp = $this->otp->validate($request->email, $request->code);
        $verefied = $user->email_verified_at;
        // dd($verefied);
        if ($verefied == null) {
            // dd($verefied);
            return new DataSuccess(
                status: false,
                data: false,
                message: 'Email not verified'
            );
        }
        if (!$otp->status) {
            return new DataFailed(
                status: false,
                message: $otp->message,
            );
        } else {
            $msg = 'تم التحقق من الكود بنجاح';
            return new DataSuccess(
                status: true,
                message: $msg
            );
        }
    }
}
