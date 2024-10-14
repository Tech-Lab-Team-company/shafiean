<?php

namespace App\Http\Resources\Organization\Landingpage\EndPoint\ServiceFeature;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\ServiceFeature\FechFeatureServiceFeatureResource;

class FetchServiceFeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id ?? 0,
            "title" => $this->title ?? '',
            "subtitle" => $this->subtitle ?? '',
            "description" => $this->description ?? '',
            "image" => $this->image_link ?? '',
            'features' => FechFeatureServiceFeatureResource::collection($this->features ?? [])
        ];
    }
}
