<?php

namespace App\Http\Resources\Organization\UserRelation;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Relation\RelationResource;
use App\Http\Resources\Organization\UserRelation\UserNameResource;

class UserRelationResource extends JsonResource
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
            'student' => new UserNameResource($this->student ?? "") ?? "",
            'user' => new UserNameResource($this->user ?? "") ?? "",
            'relation' => new RelationResource($this->relation ?? "") ?? "",
        ];
    }
}
