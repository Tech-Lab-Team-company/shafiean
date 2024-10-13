<?php

namespace App\Http\Resources\Organization\Landingpage\Subheader;

use App\Http\Resources\Organization\Landingpage\Feature\FeatureResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubheaderResource extends JsonResource
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
            'description' => $this->description,
            'organization_id' => $this->organization_id,
            'image' => $this->image_link,
            'type' => $this->type,
            'features' => FeatureResource::collection($this->features),
        ];
    }
}
