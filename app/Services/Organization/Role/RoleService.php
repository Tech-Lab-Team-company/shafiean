<?php

namespace App\Services\Organization\Role;

use Exception;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Role\Role;
use App\Models\Organization\Role\Permission;
use App\Models\Organization\Role\MapPermission;
use App\Http\Resources\Organization\Role\Role\RoleResource;
use App\Http\Resources\Organization\Season\FetchSeasonResource;
use App\Http\Resources\Organization\Role\Role\FetchRoleDetailsResource;

class RoleService
{
    public function fetchRoles()
    {
        try {
            $rules = Role::with('permissions')->paginate(10);
            return new DataSuccess(
                data: RoleResource::collection($rules),
                status: true,
                message: __('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchRoleDetails($dataRequest)
    {
        try {
            $rule = Role::with('permissions')->find($dataRequest->id);
            return new DataSuccess(
                data: new FetchRoleDetailsResource($rule),
                status: true,
                message: __('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function store($dataRequest)
    {
        try {
            $data["display_name"] = ucwords(str_replace('_', ' ', $dataRequest->name));
            $data["description"] = ucwords(str_replace('_', ' ', $dataRequest->name));
            $data["name"] = str_replace(' ', '_', $dataRequest->name);
            DB::beginTransaction();
            $role = Role::create($data);
            if ($dataRequest->modules) {
                $permissions = [];
                foreach ($dataRequest->modules as $module) {
                    foreach ($module['maps'] as $map) {
                        $permissionValue = $map['name'] . '-' . $module['name'];
                        $permission = Permission::firstOrCreate(['name' => $permissionValue]);
                        $permissions[] = $permission;
                    }
                }
                $role->syncPermissions($permissions);
            }
            DB::commit();
            return new DataSuccess(
                // data: FetchSeasonResource::collection($seasons),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update($dataRequest)
    {
        try {
            $role = Role::whereId($dataRequest->id)->first();
            $data["display_name"] = ucwords(str_replace('_', ' ', $dataRequest->name));
            $data["description"] = ucwords(str_replace('_', ' ', $dataRequest->name));
            $data["name"] = str_replace(' ', '_', $dataRequest->name);
            DB::beginTransaction();
            $role->update($data);

            if ($dataRequest->modules) {
                foreach ($dataRequest->modules as $module) {
                    foreach ($module['maps'] as $map) {
                        $permissionValue = $map['name'] . '-' . $module['name'];
                        $permissions[] = Permission::firstOrCreate(['name' => $permissionValue]);
                    }
                }
                $role->syncPermissions($permissions);
                // dd($role->permissions, $permissions);
            }

            DB::commit();
            return new DataSuccess(
                data: $role->permissions,
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($dataRequest)
    {
        try {
            $role = Role::find($dataRequest->id);
            $role->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
