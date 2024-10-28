<?php

namespace App\Http\Resources\Organization\ExamResult;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\User\UserGroupResource;

class ExamResultUserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
        ];
    }
}
