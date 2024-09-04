<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'curriculum_id' => $this->curriculum_id,
            'status' => $this->status,
            // 'type' => $this->type,
        ];
    }
}
