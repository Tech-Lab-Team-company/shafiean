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
            $privacies = Privacy::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: PrivacyResource::collection($privacies)->response()->getData(true),
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
            $privacy = Privacy::create($data);
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
    public function update(object $dataRequest): DataStatus
    {
        try {
            $privacy = Privacy::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['text'] = $dataRequest->text;
            $privacy->update($data);
            return new DataSuccess(
                data: new PrivacyResource($privacy),
                status: true,
                message: 'Privacy updated successfully'
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
            $privacy = Privacy::whereId($request->id)->first();
            if (!$privacy) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'Privacy not found'
                );
            }
            $privacy->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Privacy deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Privacy deletion failed: ' . $e->getMessage()
            );
        }
    }
}
