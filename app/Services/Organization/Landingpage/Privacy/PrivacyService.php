<?php

namespace App\Services\Organization\Landingpage\Privacy;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Privacy;
use App\Http\Resources\Organization\Landingpage\Privacy\PrivacyResource;

class PrivacyService
{

    public function index()
    {
        try {
            $privacies = Privacy::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: PrivacyResource::collection($privacies),
                status: true,
                message: 'Privacies fetched successfully'
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
        $privacy = Privacy::whereId($request->id)->first();
        return new DataSuccess(
            data: new PrivacyResource($privacy),
            statusCode: 200,
            message: 'Fetch Privacy successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'text' => $dataRequest->text,
            ];
            $privacy = Privacy::firstOrCreate();
            $privacy->update($data);
            return new DataSuccess(
                data: new PrivacyResource($privacy),
                status: true,
                message: 'Privacy created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
