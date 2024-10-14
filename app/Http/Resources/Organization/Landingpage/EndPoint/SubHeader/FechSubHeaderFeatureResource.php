<?php

namespace App\Http\Resources\Organization\Landingpage\EndPoint\SubHeader;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FechSubHeaderFeatureResource extends JsonResource
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
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image_link ?? "",
            'color' => $this->color ?? ""
        ];
    }
}
