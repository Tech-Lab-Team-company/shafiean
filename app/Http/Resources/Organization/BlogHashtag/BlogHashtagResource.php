<?php

namespace App\Http\Resources\Organization\BlogHashtag;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogHashtagResource extends JsonResource
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
        ];
    }
}
