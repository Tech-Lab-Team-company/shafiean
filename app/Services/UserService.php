<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function createUser(array $data): DataStatus
    {
        try {
            if (isset($data['image'])) {
                $imagePath = upload_image('public/users', $data['image']);
            } else {
                $imagePath = 'uploads/default.jpg';
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'api_key' => $data['api_key'],
                'image' => $imagePath,
            ]);

            return new DataSuccess(
                data: new UserResource($user),
                statusCode: 200,
                message: 'User created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateUser($id, array $data): DataStatus
    {
        try {
            $user = User::findOrFail($id);

            if (isset($data['image'])) {
                if ($user->image !== 'uploads/default.jpg') {
                    Storage::delete($user->image);
                }
                $data['image'] = upload_image('public/users', $data['image']);
            }

            $user->update($data);

            return new DataSuccess(
                data: new UserResource($user),
                statusCode: 200,
                message: 'User updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteUser($id): DataStatus
    {
        try {
            $user = User::findOrFail($id);
            if ($user->image !== 'uploads/default.jpg') {
                Storage::delete($user->image);
            }
            $user->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'User deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User deletion failed: ' . $e->getMessage()
            );
        }
    }

    public function getAllUsers()
    {
        $user = User::all();
        return new DataSuccess(
            data: new UserResource($user),
            statusCode: 200,
            message: 'User updated successfully'
        );
    }

    public function getUserById(UserRequest $id)
    {
        $user_by_id = User::find($id);
        return new DataSuccess(
            data: new UserResource($user_by_id),
            statusCode: 200,
            message: 'User updated successfully'
        );
    }
}

