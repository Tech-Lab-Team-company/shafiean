<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionTypeTitleResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id??0,
            'title' => $this->title??"",
        ];
    }
}
