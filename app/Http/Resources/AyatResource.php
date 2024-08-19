<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AyatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quraan_id' => $this->quraan_id,
            'number' => $this->number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

