<?php

namespace App\Http\Resources\Organization\Role\Role;


use Illuminate\Http\Request;
use App\Models\Organization\Role\Map;
use PhpParser\Node\Expr\AssignOp\Mod;
use App\Models\Organization\Role\Module;
use App\Models\Organization\Role\MapPermission;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Role\MapResource;
use App\Http\Resources\Organization\Role\ModuleResource;
use App\Http\Resources\Organization\Role\MapPermissionResource;

class FetchRoleDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $permissionIds = $this->permissions()->pluck('id');
        $mapPermissions = MapPermission::whereIn('permission_id', $permissionIds)->get();
        $moduleIds = $mapPermissions->pluck('module_id')->unique();
        $modules = Module::whereIn('id', $moduleIds)->get();
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
            'display_name' => $this->display_name ?? '',
            'modules' => $modules->map(function ($module) use ($mapPermissions) {
                $mapIds = $mapPermissions->where('module_id', $module->id)->pluck('map_id');
                $maps = Map::whereIn('id', $mapIds)->get();
                return [
                    'id' => $module->id ?? 0,
                    'name' => $module->name ?? "",
                    'maps' => MapResource::collection($maps ?? []) ?? []
                ];
            }),
        ];

    }
}
