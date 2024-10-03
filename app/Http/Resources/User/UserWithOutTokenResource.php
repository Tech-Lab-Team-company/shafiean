<?php

namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;

class UserWithOutTokenResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'email' => $this->email ?? "",
            'phone' => $this->phone ?? "",
            'gender' => $this->gender ?? "",
            'api_key' => $this->api_key ?? "",
            'image' => $this->image_link ?? "",
            'date_of_birth' => $this->date_of_birth ?? "",
            'identity_type' => $this->identity_type ?? "",
            'identity_number' => $this->identity_number ?? "",
            'address' => $this->address ?? "",
            'type' => $this->type ?? "",
        ];
    }
}
