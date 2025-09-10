<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\User\UserGroupResource;
use App\Http\Resources\Organization\UserRelation\UserRelationResource;
use App\Models\Organization\UserRelation\UserRelation;

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
        $user = UserRelation::whereChildId($this->id)->first();
        return [
            'id' => $this->id ?? 0,
            "organization_id" => $this->organization_id ?? 0,
            'name' => $this->name ?? "",
            'username' => $this->username ?? "",
            'email' => $this->email ?? "",
            'has_password' => isset($this->password),
            'phone' => $this->phone ?? "",
            'address' => $this->address ?? "",
            'age' => $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : 0,
            'gender' => (int) ($this->gender ?? 0),
            'api_key' => $this->api_key ?? "",
            'image' => $this->image_link ?? "",
            'token' => $this->token ?? "",
            'date_of_birth' => $this->date_of_birth ?? "",
            'identity_type' => (int) ($this->identity_type ?? 0),
            'identity_number' => (string) ($this->identity_number ?? ""),
            'type' => (int) ($this->type ?? 0),
            'parent_id' => $user->parent_id ?? '',
            'relation_id' => $user->relation_id ?? '',
            'blood_type' => $this->bloodType ? new BloodTypeResource($this->bloodType) : null,
            'country' => $this->country ? new CountryResource($this->country) : null,
            'city' => $this->city ? new CityResource($this->city) : null,
            "groups" => UserGroupResource::collection($this->groups ?? []),
        ];

    }
}
