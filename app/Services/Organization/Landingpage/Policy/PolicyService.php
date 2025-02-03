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
            $policies = Policy::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: PolicyResource::collection($policies),
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
            $policy = Policy::firstOrCreate();
            $policy->update($data);
            return new DataSuccess(
                data: new PolicyResource($policy),
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
