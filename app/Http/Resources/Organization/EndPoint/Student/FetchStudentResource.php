<?php
namespace App\Http\Resources\Organization\EndPoint\Student;

use Illuminate\Http\Resources\Json\JsonResource;

class FetchStudentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
        ];
    }
}
