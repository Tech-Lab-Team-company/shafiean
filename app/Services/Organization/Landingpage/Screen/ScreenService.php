<?php

namespace App\Services\Organization\Landingpage\Screen;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Screen;
use App\Models\Organization\Landingpage\Service;
use App\Http\Resources\Organization\Landingpage\Screen\ScreenResource;
use App\Http\Resources\Organization\Landingpage\Service\ServiceResource;

class ScreenService
{

    public function index()
    {
        try {
            $screens = Screen::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: ScreenResource::collection($screens),
                status: true,
                message: 'Screens fetched successfully'
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
        $screen = Screen::whereId($request->id)->first();
        return new DataSuccess(
            data: new ScreenResource($screen),
            statusCode: 200,
            message: 'Fetch Screen successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'image' => upload_image(image: $dataRequest->image, folder: 'screen'),
            ];
            $screen = Screen::create($data);
            return new DataSuccess(
                data: new ScreenResource($screen),
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
    public function update(object $dataRequest): DataStatus
    {
        try {
            $screen = Screen::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            if (!$screen) {
                return new DataFailed(
                    statusCode: 404,
                    message: __('messages.not_found')
                );
            }
            if ($dataRequest->image) {
                if ($screen->image) {
                    delete_image(old_image_path: $screen->image, disk: 'public');
                }
                $data['image'] = upload_image(image: $dataRequest->image, folder: 'screen');
                $screen->update($data);
            }
            return new DataSuccess(
                data: new ScreenResource($screen),
                status: true,
                message: __('messages.success_update')
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
            $screen = Screen::whereId($request->id)->first();
            if ($screen->image) {
                delete_image(old_image_path: $screen->image, disk: 'public');
            }
            $screen->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Screen deletion failed: ' . $e->getMessage()
            );
        }
    }
}
