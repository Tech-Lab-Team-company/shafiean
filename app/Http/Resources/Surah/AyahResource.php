<?php

namespace App\Http\Resources\Surah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AyahResource extends JsonResource
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
            'text' => $this->text ?? '',
            'number' => (int)$this->number ?? 0,
            'juz' => (int)$this->juz ?? 0,
            'page' => (int)$this->page ?? 0,
            'number_in_surah' => (int)$this->number_in_surah ?? 0,
            'audio' => $this->audio ?? 0,
        ];
    }
}
