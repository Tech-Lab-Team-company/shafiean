<?php

namespace App\Services;

use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Admin\AdminHistory;

class AdminHistoryService
{
    public function getAll()
    {
        $admin_history_all = AdminHistory::all();
        return new DataSuccess(
            data: $admin_history_all,
            statusCode: 200,
            message: 'Admin retrieved successfully'
        );

    }

    public function getById($id)
    {
        $admin_history_by_id = AdminHistory::find($id);
        return new DataSuccess(
            data: $admin_history_by_id,
            statusCode: 200,
            message: 'Admin_History retrieved successfully'
        );
    }

    public function create(array $data): DataStatus
    {
        $adminHistory = AdminHistory::create($data);
        return new DataSuccess(
            data: $adminHistory,
            statusCode: 200,
            message: 'Admin history created successfully'
        );
    }

    public function update($id, array $data): DataStatus
    {
        $adminHistory = AdminHistory::findOrFail($id);
        $adminHistory->update($data);
        return new DataSuccess(
            data: $adminHistory,
            statusCode: 200,
            message: 'Admin history updated successfully'
        );
    }

    public function delete(AdminHistory $adminHistory): DataStatus
    {
        $adminHistory->delete();
        return new DataSuccess(
            statusCode: 200,
            message: 'Admin history deleted successfully'
        );
    }
}


