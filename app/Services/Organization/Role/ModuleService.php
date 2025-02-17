<?php

namespace App\Services\Organization\Role;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Role\Map;
use App\Models\Organization\Role\Module;
use App\Models\Organization\Role\Permission;
use App\Models\Organization\Role\MapPermission;
use App\Http\Resources\Organization\Role\ModuleResource;

class ModuleService
{
    public function fetchAllModules()
    {
        try {
            $auth = Auth::guard('organization')->user();
            $modules = Module::with('maps')
                ->where('organization_id', $auth->organization_id)
                ->orWhereNull('organization_id')
                ->get();
            return new DataSuccess(
                data: ModuleResource::collection($modules),
                status: true,
                message: __('messages.success'),
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchModuleDetails($dataRequest)
    {
        try {
            $module = Module::with('maps')->find($dataRequest->id);
            return new DataSuccess(
                data: new ModuleResource($module),
                status: true,
                message: __('messages.success'),
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
            $module = Module::create([
                'name' => $dataRequest->name,
                'description' => $dataRequest->description
            ]);
            if ($dataRequest->has('map_ids')) {
                $module->maps()->sync($dataRequest->map_ids);
            }
            foreach ($dataRequest->map_ids as $mapId) {
                $mapValue = Map::find($mapId)->name;
                $permissions = Permission::firstOrCreate(['name' => $dataRequest->name . '-' . $mapValue]);
                MapPermission::updateOrCreate([
                    'module_id' => $module->id,
                    'map_id' => $mapId,
                ], [
                    'permission_id' => $permissions->id
                ]);
            }
            return new DataSuccess(
                data: new ModuleResource($module),
                status: true,
                message: __('messages.success_create'),
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

            $module = Module::with('maps')->find($dataRequest->id);
            $module->update([
                'name' => $dataRequest->name,
                'description' => $dataRequest->description
            ]);

            if ($dataRequest->has('map_ids')) {
                $module->maps()->sync($dataRequest->map_ids);
            }
            // $permissions = [];
            foreach ($dataRequest->map_ids as $mapId) {
                $permissionValue = Map::find($mapId)->name;
                $permissions[] = Permission::firstOrCreate(['name' => $dataRequest->name . '-' . $permissionValue]);
            }
            return new DataSuccess(
                data: new ModuleResource($module),
                status: true,
                message: __('messages.success_update'),
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
            $module = Module::find($dataRequest->id);
            $module->maps()->detach();
            $module->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_delete'),
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
