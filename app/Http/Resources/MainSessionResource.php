<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\QuraanResource;
use App\Http\Resources\Live\LiveInfoResource;
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
        $isLive = $this->lives()->count() > 0 ? true : false;
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
            'status' => $this->status ?? "",
            'start_verse' => $this->start_verse ?? "",
            'end_verse' => $this->end_verse ?? "",
            "quraan" => new QuraanResource($this->quraan) ?? "",
            "stage" => new StageResource($this->stage) ?? "",
            'is_live' => $isLive ?? "",
            'live' => $isLive ?  LiveInfoResource::collection($this->lives) : []
        ];
    }
}
