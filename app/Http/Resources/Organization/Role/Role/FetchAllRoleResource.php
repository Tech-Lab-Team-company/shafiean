<?php

namespace App\Http\Resources\Organization\Role\Role;


use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;
use App\Models\Organization\Role\Module;
use App\Models\Organization\Role\MapPermission;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Role\MapResource;
use App\Http\Resources\Organization\Role\ModuleResource;

class FetchAllRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
        ];
    }
}
