<?php

namespace App\Http\Resources\Live;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LiveInfoResource extends JsonResource
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
            "room_id" => $this->live_info->room_id ?? "",
            "host_code" => $this->live_info->host_code ?? "",
            "guest_code" => $this->live_info->guest_code ?? "",
            "description" => $this->live_info->description ?? "",
        ];
    }
}
