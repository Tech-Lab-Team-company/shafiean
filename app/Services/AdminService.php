<?php

namespace App\Services;


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

    public function create(array $data)
    {
        return Admin::create($data);
    }

    public function update(Admin $admin, array $data)
    {
        $admin->update($data);
        return $admin;
    }

    public function delete(Admin $admin)
    {
        return $admin->delete();
    }
}

