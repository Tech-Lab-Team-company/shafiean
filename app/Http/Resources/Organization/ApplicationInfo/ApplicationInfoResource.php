<?php

namespace App\Http\Resources\Organization\ApplicationInfo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationInfoResource extends JsonResource
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
            'description' => $this->description ?? "",
            'android_url' => $this->android_url ?? "",
            'ios_url' => $this->ios_url ?? "",
            'image' => $this->image_link ?? "",
            'type' => (int)$this->type ?? 0
        ];
    }
}
