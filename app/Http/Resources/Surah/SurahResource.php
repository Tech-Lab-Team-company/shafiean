<?php

namespace App\Http\Resources\Surah;

use Illuminate\Http\Request;
use App\Http\Resources\Surah\AyahResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
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
            'name' => $this->name ?? '',
            'number' => (int) $this->number ?? '',
            'revelation_type' => $this->revelation_type ?? '',
            'ayahs' => AyahResource::collection($this->ayahs) ?? [],
        ];
    }
}
