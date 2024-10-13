<?php

namespace App\Http\Resources\Organization\Landingpage\Opinion;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpinionResource extends JsonResource
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
            'name' => $this->name ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
