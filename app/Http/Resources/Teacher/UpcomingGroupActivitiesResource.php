<?php

namespace App\Http\Resources\Teacher;


use Illuminate\Http\Resources\Json\JsonResource;

class UpcomingGroupActivitiesResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'date' => $this->created_at->translatedFormat('j F') ?? '',
            'title' => $this->title ?? '',
            'group_name' => $this->group->title ?? '',
        ];
    }
}
