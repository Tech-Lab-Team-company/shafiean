<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'api_key' => $data['api_key'],
            'image' => $data['image'],
        ]);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'api_key' => $data['api_key'],
            'image' => $data['image'],
        ]);

        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }
}
