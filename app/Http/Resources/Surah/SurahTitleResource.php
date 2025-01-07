<?php

namespace App\Http\Resources\Surah;

use Illuminate\Http\Request;
use App\Http\Resources\Surah\AyahResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SurahTitleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sessionId = $request->session_id;
        if ($sessionId != null) {
            $data['id'] = $this->surah->id ?? 0;
            $data['title'] = $this->surah->name ?? '';
            $data['from_ayah_id'] = $this->startAyah->id ?? 0;
            $data['from_ayah_title'] = $this->startAyah->text ?? '';
            $data['to_ayah_id'] = $this->endAyah->id ?? 0;
            $data['to_ayah_title'] = $this->endAyah->text ?? '';
        } else {
            $data['id'] = $this->id ?? 0;
            $data['title'] = $this->name ?? '';
        }
        return $data;
    }
}
