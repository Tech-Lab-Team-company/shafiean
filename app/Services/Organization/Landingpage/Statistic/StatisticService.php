<?php

namespace App\Services\Organization\Landingpage\Statistic;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Statistic;
use App\Http\Resources\Organization\Landingpage\Statistic\StatisticResource;

class StatisticService
{

    public function index()
    {
        try {
            $statistics = Statistic::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: StatisticResource::collection($statistics),
                status: true,
                message: 'Statistics fetched successfully'
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
        $statistic = Statistic::whereId($request->id)->first();
        return new DataSuccess(
            data: new StatisticResource($statistic),
            statusCode: 200,
            message: 'Fetch Statistic successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'title' => $dataRequest->title,
                'sub_title' => $dataRequest->sub_title,
                'image' => upload_image(image: $dataRequest->image, folder: 'statistic'),
            ];
            $statistic = Statistic::create($data);
            return new DataSuccess(
                data: new StatisticResource($statistic),
                status: true,
                message: 'Statistic created successfully'
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
            $statistic = Statistic::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['title'] = $dataRequest->title;
            $data['sub_title'] = $dataRequest->sub_title;
            if ($dataRequest->image) {
                if ($statistic->image) {
                    delete_image(old_image_path: $statistic->image, disk: 'public');
                }
                $data['image'] = upload_image(image: $dataRequest->image, folder: 'statistic');
            }
            $statistic->update($data);
            return new DataSuccess(
                data: new StatisticResource($statistic),
                status: true,
                message: 'Statistic updated successfully'
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
            $statistic = Statistic::whereId($request->id)->first();
            if (!$statistic) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'Statistic not found'
                );
            }
            if ($statistic->image) {
                delete_image(old_image_path: $statistic->image, disk: 'public');
            }
            $statistic->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Statistic deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Statistic deletion failed: ' . $e->getMessage()
            );
        }
    }
}
