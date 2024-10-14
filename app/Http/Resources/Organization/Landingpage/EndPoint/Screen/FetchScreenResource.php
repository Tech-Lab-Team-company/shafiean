<?php

namespace App\Http\Resources\Organization\Landingpage\EndPoint\Screen;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\SubHeader\FechSubHeaderFeatureResource;

use function PHPSTORM_META\map;

class FetchScreenResource extends JsonResource
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
           "image" => $this->image_link ?? "",
        ];
    }
}
