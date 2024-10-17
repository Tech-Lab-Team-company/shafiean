<?php

namespace App\Http\Resources\Organization\EndPoint\Curriculum;


use Illuminate\Http\Resources\Json\JsonResource;

class FetchCurriculumStageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
        ];
    }
}
