<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'licence_number' => $this->licence_number,
            'website_link' => $this->website_link,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            "image" => $this->image_link,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'manager_name' => $this->manager_name,
            'manager_phone' => $this->manager_phone,
            'manager_email' => $this->manager_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'disabilities' => DisabilityTypeResource::collection($this->disability_types),
        ];
    }
}
