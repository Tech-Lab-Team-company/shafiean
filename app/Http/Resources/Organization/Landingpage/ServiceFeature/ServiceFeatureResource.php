<?php

namespace App\Http\Resources\Organization\Landingpage\ServiceFeature;

use App\Http\Resources\Organization\Landingpage\Feature\FeatureResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceFeatureResource extends JsonResource
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
            'features' => FeatureResource::collection($this->features),
        ];
    }
}
