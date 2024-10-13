<?php
namespace App\Http\Resources\Organization\Landingpage\Statistic;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
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
            'sub_title' => $this->sub_title ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
