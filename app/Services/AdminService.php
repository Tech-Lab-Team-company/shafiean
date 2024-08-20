<?php

namespace App\Services;

use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Admin\Admin;

class AdminService
{
    public function getAll()
    {
        $admin_all = Admin::all();
        return new DataSuccess(
            data: $admin_all,
            statusCode: 200,
            message: 'Admin retrieved successfully'
        );

    }

    public function getById($id)
    {
        $admin_by_id = Admin::find($id);
        return new DataSuccess(
            data: $admin_by_id,
            statusCode: 200,
            message: 'Admin retrieved successfully'
        );
    }

    public function create(array $data): DataStatus
    {
        $admin = Admin::create($data);
        return new DataSuccess(
            data: $admin,
            statusCode: 200,
            message: 'Admin created successfully'
        );
    }

    public function update($id, array $data): DataStatus
    {
        $admin = Admin::findOrFail($id);
        $admin->update($data);

        return new DataSuccess(
            data: $admin,
            statusCode: 200,
            message: 'Admin updated successfully'
        );
    }

    public function delete($id): DataStatus
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return new DataSuccess(
            statusCode: 200,
            message: 'Admin deleted successfully'
        );
    }
}


