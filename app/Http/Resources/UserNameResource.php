<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\User\UserGroupResource;
use App\Http\Resources\Organization\UserRelation\UserRelationResource;
use App\Models\Organization\UserRelation\UserRelation;

class UserNameResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
        ];
    }
}
