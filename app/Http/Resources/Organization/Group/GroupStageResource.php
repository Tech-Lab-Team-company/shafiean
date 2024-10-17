<?php
namespace App\Http\Resources\Organization\Group;


use Illuminate\Http\Resources\Json\JsonResource;

class GroupStageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
        ];
    }
}
