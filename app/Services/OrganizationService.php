<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\DB;

class OrganizationService
{
    public function getAllOrganizations()
    {
        return Organization::all();
    }

    public function getOrganizationById($id)
    {
        return Organization::findOrFail($id);
    }

    public function createOrganization($data)
    {
        return Organization::create($data);
    }

    public function updateOrganization($id, $data)
    {
        $organization = Organization::findOrFail($id);
        $organization->update($data);
        return $organization;
    }

    public function deleteOrganization($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();
        return $organization;
    }
}

