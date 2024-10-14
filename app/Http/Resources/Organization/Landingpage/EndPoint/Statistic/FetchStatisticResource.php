<?php

namespace App\Http\Resources\Organization\Landingpage\EndPoint\Statistic;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\SubHeader\FechSubHeaderFeatureResource;

class FetchStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id ?? 0,
            'image' => $this->image_link ?? "",
            "count" => [
                "title" => $this->title ?? "",
                "sub_title" => $this->sub_title ?? ""
            ],
        ];
    }
}
