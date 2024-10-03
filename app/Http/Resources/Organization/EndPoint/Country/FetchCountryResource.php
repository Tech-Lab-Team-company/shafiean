<?php
namespace App\Http\Resources\Organization\EndPoint\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class FetchCountryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id??0,
            'title' => $this->title??"",
        ];
    }
}
