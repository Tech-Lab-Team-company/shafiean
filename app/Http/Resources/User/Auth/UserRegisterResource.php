<?php

namespace App\Http\Resources\User\Auth;

use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;
use App\Http\Resources\BloodTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterResource extends JsonResource
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
            'blood_type' => new BloodTypeResource($this->bloodType ?? "") ?? "",
            'country' => new CountryResource($this->country ?? "") ?? "",
        ];
    }
}
