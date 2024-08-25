<?php

namespace App\Http\Controllers;

use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login (Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $admin = Admin::where('email', $credentials['email'])->first();
//        dd($admin);
        if (!$admin || Hash::check($credentials['password'], $admin->password)) {
            return response()->json([
                'message' => 'password is wrong',
            ], 401);
        }
        Auth::login($admin);
        $token = $admin->createToken('admin_token')->plainTextToken;
        $data = new AdminResource($admin,$token);

        return response()->json([
            'message' => 'Login successful',
            'data' => $data,
            'code'  => 200
        ], 200);
    }

    public function logout (Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->tokens()->delete();
        return response()->json([
            'message' => 'Admin Logout successful',
        ], 200);
    }
}
