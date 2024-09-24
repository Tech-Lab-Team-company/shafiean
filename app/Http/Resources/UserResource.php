<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $token;
    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }
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
            'token' => $this->token ?? "",
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
