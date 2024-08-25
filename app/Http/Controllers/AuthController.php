<?php

namespace App\Http\Controllers;

use App\Helpers\Response\DataSuccess;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();

        if(!$user || Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'password is wrong '
            ], 404);
        }
        Auth::login($user);
        $token = $user->createToken('user_token')->plainTextToken;

        $data = new UserResource($user,$token);
        $msg = 'login success';
        return response()->json([
            'message' => 'Login successful',
            'data' =>  $data,
            'code'  => 200
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        dd($request);
        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }

}
