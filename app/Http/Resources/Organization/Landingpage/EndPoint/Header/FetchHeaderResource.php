<?php

namespace App\Http\Resources\Organization\Landingpage\EndPoint\Header;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchHeaderResource extends JsonResource
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
            'subtitle' => $this->subtitle ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
