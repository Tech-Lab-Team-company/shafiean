<?php

namespace App\Services\Organization\Role;

use Exception;
use App\Models\Season;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Role\Map;
use App\Http\Resources\Organization\Role\MapResource;
use App\Http\Resources\Organization\Season\FetchSeasonResource;

class MapService
{
    public function fetchAllMaps()
    {
        try {
            $auth = Auth::guard('organization')->user();
            $maps = Map::where('organization_id', $auth->organization_id)
                ->orWhereNull('organization_id')
                ->get();
            return new DataSuccess(
                data: MapResource::collection($maps),
                status: true,
                message: __('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function store($dataRequest)
    {
        try {
            $map = Map::create(['name' => $dataRequest->name, 'description' => $dataRequest->description]);
            return new DataSuccess(
                data: new MapResource($map),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
