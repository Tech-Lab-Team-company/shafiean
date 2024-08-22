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
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        Auth::guard('admin')->login($admin);
        $token = $admin->createToken('admin_token')->plainTextToken;

        $data = new AdminResource($admin,$token);
        $msg = 'login success';
        return response()->json([
            'message' => 'Login successful',
            'data' => $data,
            'code'  => 200
        ], 200);
    }

    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
}
