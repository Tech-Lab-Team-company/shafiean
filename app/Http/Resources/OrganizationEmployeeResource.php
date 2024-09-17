<?php

namespace App\Http\Resources;

use App\Enum\EmployeeTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image_link,
            'phone' => $this->phone,
            'is_master' => $this->is_master,
            'organization_id' => $this->organization_id,
            'status' => EmployeeTypeEnum::from($this->is_employed)->label(),
        ];
    }
}
