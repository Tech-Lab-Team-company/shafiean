<?php

namespace App\Http\Resources\Organization\MainSession;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchMainSessionForSessionResource extends JsonResource
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
            'stage_title' => $this?->stage?->title ?? "",
            // 'stage_type' => $this?->stage?->type ?? "",
            'session_type' => $this->session_type->title ?? "",
            'disability_types' => $this?->stage?->disabilityTypes->pluck('title')->implode(', ') ?? "", // This is a collection of disability types
            'curriculum_title' => $this?->stage->curriculum->title ?? "",
            'surah_title' => $this->surah->name ?? "",
            'surah_id' => $this->surah->id ?? "",
            'start_ayah_id' => $this->startAyah->number_in_surah ?? "",
            'start_ayah_title' => $this->startAyah->text ?? "",
            'end_ayah_id' => $this->endAyah->number_in_surah ?? "",
            'end_ayah_title' => $this->endAyah->text ?? "",
        ];
    }
}
