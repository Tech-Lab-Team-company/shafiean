<?php

namespace App\Services\Organization\Landingpage\Service;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Models\Organization\Landingpage\Service;
use App\Http\Resources\Organization\Landingpage\Service\ServiceResource;

class ServiceLandingService
{

    public function index($dataRequest)
    {
        try {
            $query = Service::query();
            if (isset($dataRequest)) {
                $filter_service = new FilterService();
                $filter_service->filterServices($query, $dataRequest);
            }
            $services = $query->paginate(10);
            return new DataSuccess(
                data: ServiceResource::collection($services)->response()->getData(true),
                status: true,
                message: 'Services fetched successfully'
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
        $service = Service::whereId($request->id)->first();
        return new DataSuccess(
            data: new ServiceResource($service),
            statusCode: 200,
            message: 'Fetch Service successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'title' => $dataRequest->title,
                'sub_title' => $dataRequest->sub_title,
                'image' => upload_image(image: $dataRequest->image, folder: 'service'),
            ];
            $service = Service::create($data);
            return new DataSuccess(
                data: new ServiceResource($service),
                status: true,
                message: 'Service created successfully'
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
            $service = Service::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['title'] = $dataRequest->title;
            $data['sub_title'] = $dataRequest->sub_title;
            if ($dataRequest->image) {
                if ($service->image) {
                    delete_image(old_image_path: $service->image, disk: 'public');
                }
                $data['image'] = upload_image(image: $dataRequest->image, folder: 'service');
            }
            $service->update($data);
            return new DataSuccess(
                data: new ServiceResource($service),
                status: true,
                message: 'Service updated successfully'
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
            $service = Service::whereId($request->id)->first();
            if (!$service) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'Service not found'
                );
            }
            if ($service->image) {
                delete_image(old_image_path: $service->image, disk: 'public');
            }
            $service->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Service deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Service deletion failed: ' . $e->getMessage()
            );
        }
    }
}
