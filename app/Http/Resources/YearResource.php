<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Alkoumi\LaravelHijriDate\Hijri;


class YearResource extends JsonResource
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
            'status' => $this->status,
            'country' => new CountryResource($this->country),
            'start_date' => $this->start_date ?? '',
            // 'hijri_start_date' => $this->start_date ? Carbon::parse($this->start_date)->toHijri()->isoFormat('LLLL') : "",
            // 'end_date' => $this->end_date ?? "",
            // 'hijri_end_date' => $this->end_date ? Carbon::parse($this->end_date)->toHijri()->isoFormat('LLLL') : "",
            'hijri_start_date' => $this->start_date
                ? Hijri::Date('l d F o', $this->start_date)
                : "",
            'end_date' => $this->end_date ?? '',
            'hijri_end_date' => $this->end_date
                ? Hijri::Date('l d F o', $this->end_date)
                : "",
        ];
    }
}
