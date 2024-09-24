<?php

namespace App\Services\Organization\Relation;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Relation\RelationResource;
use App\Models\Organization\Relation\Relation;

class RelationService
{
    public function index()
    {
        try {
            $relations = Relation::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: RelationResource::collection($relations)->response()->getData(true),
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
    public function show($request)
    {
        $relations = Relation::whereId($request->id)->first();
        return new DataSuccess(
            data: new RelationResource($relations),
            statusCode: 200,
            message: 'Fetch relation successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $relation = Relation::create($dataRequest);
            return new DataSuccess(
                data: new RelationResource($relation),
                status: true,
                message: 'Relation created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $relation = Relation::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $relation->update($dataRequest);
            return new DataSuccess(
                data: new RelationResource($relation),
                status: true,
                message: 'Relation updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($request): DataStatus
    {
        try {
            Relation::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Relation deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Relation deletion failed: ' . $e->getMessage()
            );
        }
    }
}
