<?php

namespace App\Http\Resources\User\Profile;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\User\UserGroupResource;

class UserProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'email' => $this->email ?? "",
            'phone' => $this->phone ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
