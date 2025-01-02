<?php

namespace App\Http\Resources\Organization\MainSession;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchAdminSessionResource extends JsonResource
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
            'stage_title' => $this->stage->title ?? "",
            'stage_type' => $this->stage->type ?? "",
            'disability_types' => $this->stage?->disabilityTypes->pluck('title')->implode(', ') ?? "", // This is a collection of disability types
            'curriculum_title' => $this->stage->curriculum->title ?? "",
            'surah_title' => $this->surah->name ?? "",
            'start_ayah' => $this->startAyah->number_in_surah ?? "",
            'start_ayah_title' => $this->startAyah->text ?? "",
            'end_ayah' => $this->endAyah->number_in_surah ?? "",
            'end_ayah_title' => $this->endAyah->text ?? "",
        ];
    }
}
