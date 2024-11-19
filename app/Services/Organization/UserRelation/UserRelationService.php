<?php

namespace App\Services\Organization\UserRelation;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\UserRelation\UserRelation;
use App\Http\Resources\Organization\UserRelation\UserRelationResource;

class UserRelationService
{
    public function index()
    {
        try {
            $relations = UserRelation::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: UserRelationResource::collection($relations)->response()->getData(true),
                status: true,
                message: 'UserRelations fetched successfully'
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
        $relations = UserRelation::whereId($request->id)->first();
        return new DataSuccess(
            data: new UserRelationResource($relations),
            statusCode: 200,
            message: 'Fetch UserRelation successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $relation = UserRelation::create($dataRequest);
            return new DataSuccess(
                data: new UserRelationResource($relation),
                status: true,
                message: 'UserRelation created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function storeParentRelation($relationId, $userId, $parentId)
    {
        // try {
        UserRelation::create([
            'relation_id' => $relationId,
            'child_id' => $userId,
            'parent_id' => $parentId
        ]);
        // return new DataSuccess(
        // data: new UserRelationResource($relation),
        // status: true,
        // message: 'UserRelation created successfully'
        // );
        // } catch (Exception $e) {
        // return new DataFailed(
        // status: false,
        // message: $e->getMessage()
        // );
        // }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $relation = UserRelation::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $relation->update($dataRequest);
            return new DataSuccess(
                data: new UserRelationResource($relation),
                status: true,
                message: 'UserRelation updated successfully'
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
            UserRelation::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'UserRelation deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'UserRelation deletion failed: ' . $e->getMessage()
            );
        }
    }
}
