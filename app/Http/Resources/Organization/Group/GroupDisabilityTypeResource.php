<?php

namespace App\Http\Resources\Organization\Group;


use Illuminate\Http\Resources\Json\JsonResource;

class GroupDisabilityTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
            'order' => $this->order ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
