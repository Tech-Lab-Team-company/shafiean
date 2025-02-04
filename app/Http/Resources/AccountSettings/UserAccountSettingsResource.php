<?php

namespace App\Http\Resources\AccountSettings;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'image' => $this->image_link ?? '',
        ];
    }
}
