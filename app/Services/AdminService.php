<?php

namespace App\Services;

use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Admin\Admin;

class AdminService
{
    public function getAll()
    {
        return Admin::all();
    }

    public function getById($id)
    {
        return Admin::findOrFail($id);
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


