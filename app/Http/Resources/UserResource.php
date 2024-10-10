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
            'gender' => (int) $this->gender ?? 0,
            'api_key' => $this->api_key ?? "",
            'image' => $this->image_link ?? "",
            'token' => $this->token ?? "",
            'date_of_birth' => $this->date_of_birth ?? "",
            'identity_type' => (int) $this->identity_type ?? 0,
            'identity_number' => (int)$this->identity_number ?? 0,
            'address' => $this->address ?? "",
            'type' => (int) $this->type ?? 0,
            'blood_type' => new BloodTypeResource($this->bloodType ?? "") ?? "",
            'country' => new CountryResource($this->country ?? "") ?? "",
        ];
    }
}
