<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'timestamp' => $this->timestamp,
            'type' => $this->type,
            'order' => $this->order,
            'curriculum_id' => $this->curriculum_id,
            'disability_type_id' => $this->disability_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

