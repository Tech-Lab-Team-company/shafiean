<?php

namespace App\Services\Organization\Landingpage\Partner;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Partner;
use App\Models\Organization\Landingpage\Statistic;
use App\Http\Resources\Organization\Landingpage\Partner\PartnerResource;

class PartnerService
{

    public function index()
    {
        try {
            $partners = Partner::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: PartnerResource::collection($partners),
                status: true,
                message: 'Partners fetched successfully'
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
        $partner = Partner::whereId($request->id)->first();
        return new DataSuccess(
            data: new PartnerResource($partner),
            statusCode: 200,
            message: 'Fetch Partner successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {

            $data = [
                'title' => $dataRequest->title,
                'link' => $dataRequest->link,
            ];
            if (isset($dataRequest['image'])) {
                $data['image'] = upload_image($dataRequest['image'], 'partner');
            }
            $partner = Partner::create($data);
            return new DataSuccess(
                data: new PartnerResource($partner),
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
            $partner = Partner::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['title'] = $dataRequest->title;
            $data['link'] = $dataRequest->link;
            if ($dataRequest->image) {
                if ($partner->image) {
                    delete_image(old_image_path: $partner->image, disk: 'public');
                }
                $data['image'] = upload_image(image: $dataRequest->image, folder: 'partner');
            }
            $partner->update($data);
            return new DataSuccess(
                data: new PartnerResource($partner),
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
            $partner = Partner::whereId($request->id)->first();
            if (!$partner) {
                return new DataFailed(
                    statusCode: 404,
                    message: __('messages.not_found')
                );
            }
            if ($partner->image) {
                delete_image(old_image_path: $partner->image, disk: 'public');
            }
            $partner->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Partner deletion failed: ' . $e->getMessage()
            );
        }
    }
}
