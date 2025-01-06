<?php

namespace App\Http\Resources\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Resources\Surah\AyahResource;
use App\Http\Resources\Surah\AyahTitleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionAyahResource extends JsonResource
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
            'start_ayah' => new AyahTitleResource($this->startAyah) ?? '',
            'end_ayah' => new AyahTitleResource($this->endAyah) ?? '',
        ];
    }
}
