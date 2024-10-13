<?php

namespace App\Services\Organization\Landingpage\Opinion;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Opinion;
use App\Http\Resources\Organization\Landingpage\Opinion\OpinionResource;

class OpinionService
{

    public function index()
    {
        try {
            $opinions = Opinion::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: OpinionResource::collection($opinions)->response()->getData(true),
                status: true,
                message: 'Opinions fetched successfully'
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
        $opinion = Opinion::whereId($request->id)->first();
        return new DataSuccess(
            data: new OpinionResource($opinion),
            statusCode: 200,
            message: 'Fetch Opinion successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'name' => $dataRequest->name,
                'description' => $dataRequest->description,
                'image' => upload_image(image: $dataRequest->image, folder: 'opinion'),
            ];
            $opinion = Opinion::create($data);
            return new DataSuccess(
                data: new OpinionResource($opinion),
                status: true,
                message: 'Opinion created successfully'
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
            $opinion = Opinion::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['name'] = $dataRequest->name;
            $data['description'] = $dataRequest->description;
            if ($dataRequest->image) {
                if ($opinion->image) {
                    delete_image(old_image_path: $opinion->image, disk: 'public');
                }
                $data['image'] = upload_image(image: $dataRequest->image, folder: 'opinion');
            }
            $opinion->update($data);
            return new DataSuccess(
                data: new OpinionResource($opinion),
                status: true,
                message: 'Opinion updated successfully'
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
            $opinion = Opinion::whereId($request->id)->first();
            if (!$opinion) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'Opinion not found'
                );
            }
            if ($opinion->image) {
                delete_image(old_image_path: $opinion->image, disk: 'public');
            }
            $opinion->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Opinion deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Opinion deletion failed: ' . $e->getMessage()
            );
        }
    }
}
