<?php

namespace App\Http\Resources\User\Auth;


use App\Http\Resources\CountryResource;
use App\Http\Resources\BloodTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'email' => $this->email ?? "",
            'phone' => $this->phone ?? "",
            'gender' => (int) $this->gender ?? "",
            'image' => $this->image_link ?? "",
            'token' => $this->additional['token'] ?? "",
            'date_of_birth' => $this->date_of_birth ?? "",
            'identity_type' => (int) $this->identity_type ?? "",
            'identity_number' => (int)$this->identity_number ?? "",
            'address' => $this->address ?? "",
            'type' => (int)$this->type ?? "",
        ];
    }
}
