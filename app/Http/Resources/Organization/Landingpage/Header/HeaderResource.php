<?php

namespace App\Http\Resources\Organization\Landingpage\Header;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
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
            'image' => $this->image_link ?? "",
            'description' => $this->description ?? "",
            'title' => $this->title ?? "",
            'subtitle' => $this->subtitle ?? "",
        ];
    }
}
