<?php

namespace App\Http\Resources\Organization\Role\Role;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Role\ModuleResource;
use App\Models\Organization\Role\Module;
use PhpParser\Node\Expr\AssignOp\Mod;

class FetchRoleDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $modules = Module::with('maps')->get();
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
            'display_name' => $this->display_name ?? '',
            'description' => $this->description ?? '',
            'permissions' =>  $this->permissions,
            // 'modules' => ModuleResource::collection($modules)
        ];
    }
}
