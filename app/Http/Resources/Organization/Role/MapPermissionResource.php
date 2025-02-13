<?php

namespace App\Http\Resources\Organization\Role;



use Illuminate\Http\Request;
use App\Models\Organization\Role\Map;
use Illuminate\Http\Resources\Json\JsonResource;

class MapPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->map->id ?? 0,
            'name' => $this->map->name ?? '',
        ];
    }
}
