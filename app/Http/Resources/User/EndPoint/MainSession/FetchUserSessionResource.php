<?php
namespace App\Http\Resources\User\EndPoint\MainSession;


use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\QuraanResource;
use App\Http\Resources\Live\LiveInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchUserSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isLive = $this->lives()->count() > 0 ? true : false;
        return [
            'id' => $this->session->id ?? 0,
            'title' => $this->session->title ?? "",
            'status' => $this->session->status ?? "",
            'start_verse' => $this->session->start_verse ?? "",
            'end_verse' => $this->session->end_verse ?? "",
            "quraan" => new QuraanResource($this->session->quraan) ?? "",
            "stage" => new StageResource($this->session->stage) ?? "",
            'is_live' => $isLive ?? "",
            'live' => $isLive ?  LiveInfoResource::collection($this->lives) : []
        ];
    }
}
