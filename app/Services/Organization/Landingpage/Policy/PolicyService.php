<?php

namespace App\Services\Organization\Landingpage\Policy;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Policy;
use App\Http\Resources\Organization\Landingpage\Policy\PolicyResource;

class PolicyService
{

    public function index()
    {
        try {
            $policies = Policy::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: PolicyResource::collection($policies)->response()->getData(true),
                status: true,
                message: 'Policies fetched successfully'
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
        $policy = Policy::whereId($request->id)->first();
        return new DataSuccess(
            data: new PolicyResource($policy),
            statusCode: 200,
            message: 'Fetch Policy successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'text' => $dataRequest->text,
            ];
            $policy = Policy::create($data);
            return new DataSuccess(
                data: new PolicyResource($policy),
                status: true,
                message: 'Policy created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(object $dataRequest): DataStatus
    {
        try {
            $policy = Policy::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['text'] = $dataRequest->text;
            $policy->update($data);
            return new DataSuccess(
                data: new PolicyResource($policy),
                status: true,
                message: 'Policy updated successfully'
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
            $policy = Policy::whereId($request->id)->first();
            if (!$policy) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'Policy not found'
                );
            }
            $policy->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Policy deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Policy deletion failed: ' . $e->getMessage()
            );
        }
    }
}
