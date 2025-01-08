<?php

namespace App\Http\Resources\Organization\MainSession;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchMainSessionIndexForGroupResource extends JsonResource
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
            'session_type' => $this->session_type->title ?? "",
            'curriculum_title' => $this->stage->curriculum->title ?? "",
            'surah_title' => $this->surah->name ?? "",
            // 'surah_id' => $this->surah->id ?? "",
            // 'start_ayah_id' => $this->startAyah->number_in_surah ?? "",
            'start_ayah_title' => $this->startAyah->text ?? "",
            // 'end_ayah_id' => $this->endAyah->number_in_surah ?? "",
            'end_ayah_title' => $this->endAyah->text ?? "",
            'teacher_name' => $this->teacher->name ?? ""
        ];
    }
}
