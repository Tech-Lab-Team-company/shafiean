<?php

namespace App\Services;

use App\Models\Admin\AdminHistory;

class AdminHistoryService
{
    public function getAll()
    {
        return AdminHistory::all();
    }

    public function getById($id)
    {
        return AdminHistory::findOrFail($id);
    }

    public function create(array $data)
    {
        return AdminHistory::create($data);
    }

    public function update(AdminHistory $adminHistory, array $data)
    {
        $adminHistory->update($data);
        return $adminHistory;
    }

    public function delete(AdminHistory $adminHistory)
    {
        return $adminHistory->delete();
    }
}

