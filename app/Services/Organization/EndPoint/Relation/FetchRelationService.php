<?php

namespace App\Services\Organization\EndPoint\Relation;



use Exception;
use App\Models\User;
use App\Models\Season;
use App\Enum\UserTypeEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Relation\Relation;
use App\Http\Resources\Organization\Season\FetchSeasonResource;
use App\Http\Resources\Organization\EndPoint\Student\FetchStudentResource;
use App\Http\Resources\Organization\EndPoint\Relation\FetchRelationResource;

class FetchRelationService

{
    public function fetchRelations()
    {
        try {
            $relations = Relation::get();
            return new DataSuccess(
                data: FetchRelationResource::collection($relations),
                status: true,
                message: 'Relations fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
