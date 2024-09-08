<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'start_verse' => $this->start_verse,
            'end_verse' => $this->end_verse,
            "quraan" => new QuraanResource($this->quraan),
            "stage" => new StageResource($this->stage),
        ];
    }
}
