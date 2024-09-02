<?php

namespace App\Services;

use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAll()
    {
        $admin_all = Admin::all();
        return new DataSuccess(
            data: AdminResource::collection($admin_all),
            status: true,
            message: 'Admin retrieved successfully'
        );
    }

    public function getById($request)
    {
        $admin_by_id = Admin::find($request->id);
        return new DataSuccess(
            data: new AdminResource($admin_by_id),
            status: true,
            message: 'Admin retrieved successfully'
        );
    }

    public function create($request): DataStatus
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        // dd($data);
        $data['password'] = $request->password;
        $data['phone'] = $request->phone;
        if ($request->hasFile('image')) {
            $image = upload_image($request->file('image'), 'admin');
            $data['image'] = $image;
        }
        // dd($data);
        $admin = Admin::create($data);
        // $token = $admin->createToken('admin_token')->plainTextToken;
        return new DataSuccess(
            data: new AdminResource($admin),
            status: true,
            message: 'Admin created successfully'
        );
    }

    public function update(array $data): DataStatus
    {
        // dd($data);
        $admin = Admin::find($data['id']);
        // dd($admin);
        if (isset($data['image'])) {
            delete_image($admin->image);
            $adminData['image'] = upload_image('admins', $data['image']);
        }

        $adminData['name'] = $data['name'] ?? $admin->name;
        $adminData['email'] = $data['email'] ?? $admin->email;
        // $adminData['password'] = Hash::make($data['password']) ;
        $adminData['phone'] = $data['phone'] ?? $admin->phone;

        $admin->update($data);
        return new DataSuccess(
            data: new AdminResource($admin),
            status: true,
            message: 'Admin updated successfully'
        );
    }

    public function delete($request): DataStatus
    {
        $admin = Admin::find($request->id);
        $admin->delete();
        return new DataSuccess(
            status: true,
            message: 'Admin deleted successfully'
        );
    }
}
