<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\User\UserGroupResource;
use App\Http\Resources\Organization\UserRelation\UserRelationResource;
use App\Models\Organization\UserRelation\UserRelation;

class MiniUserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'email' => $this->email ?? "",
            'phone' => $this->phone ?? "",
            'address' => $this->address ?? "",
            'age' => Carbon::parse($this->date_of_birth)->age ?? 0,
            'gender' => (int) $this->gender ?? 0,
            'image' => $this->image_link ?? "",
            'date_of_birth' => $this->date_of_birth ?? "",
            'identity_type' => (int) $this->identity_type ?? 0,
            'identity_number' => (int)$this->identity_number ?? 0,
            'type' => (int) $this->type ?? 0,
            'parent_id' => $user->parent_id ?? '',
            'relation_id' => $user->relation_id ?? '',
        ];
    }
}
