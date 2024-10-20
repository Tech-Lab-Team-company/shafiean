<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use App\Services\Global\FilterService;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAll($request)
    {
        $query = Admin::query();
        // dd($request);
        $filter_service = new FilterService();
        if (isset($request)) {
            $filter_service->filterAdmins($query, $request);
        }

        $admin_all = $query->orderBy('id', 'desc')->paginate(10);

        return new DataSuccess(
            data: AdminResource::collection($admin_all)->response()->getData(true),
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

    public function update($request): DataStatus
    {
        // dd($request->all());
        $admin = Admin::find($request->id);
        // dd($admin);
        if ($request->hasFile('image')) {

            if ($admin->image && file_exists($admin->image)) {
                delete_image($admin->image);
            }
            $adminData['image'] = upload_image($request->file('image'), 'admin');
        }

        $adminData['name'] = $request->name ?? $admin->name;
        $adminData['email'] = $request->email ?? $admin->email;
        // $adminData['password'] = Hash::make($data['password']) ;
        $adminData['phone'] = $request->phone ?? $admin->phone;
        // dd($adminData);
        $admin->update($adminData);
        return new DataSuccess(
            data: new AdminResource($admin),
            status: true,
            message: 'Admin updated successfully'
        );
    }

    public function delete($request): DataStatus
    {
        try {
            $admin = Admin::find($request->id);

            if ($admin?->is_master == 1) {
                return new DataFailed(
                    status: false,
                    message: 'Master admin can not be deleted'
                );
            }
            $admin->delete();
            return new DataSuccess(
                status: true,
                message: 'Admin deleted successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Admin deletion failed: ' . $e->getMessage()
            );
        }
    }

    public function editPassword($request): DataStatus
    {
        try {
            $admin = Admin::find($request->id);

            if ($admin->is_master == 1) {
                return new DataFailed(
                    status: false,
                    message: 'Master admin can not change password'
                );
            }
            $admin->password = Hash::make($request->password);
            $admin->save();
            return new DataSuccess(
                status: true,
                message: 'Password updated successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Password update failed: ' . $e->getMessage()
            );
        }
    }
}
