<?php

namespace App\Services\Organization\Landingpage\CommonQuestion;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\CommonQuestion;
use App\Http\Resources\Organization\Landingpage\CommonQuestion\CommonQuestionResource;

class CommonQuestionService
{

    public function index()
    {
        try {
            $commonQuestions = CommonQuestion::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: CommonQuestionResource::collection($commonQuestions),
                status: true,
                message: 'Common Questions fetched successfully'
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
        $commonQuestion = CommonQuestion::whereId($request->id)->first();
        return new DataSuccess(
            data: new CommonQuestionResource($commonQuestion),
            statusCode: 200,
            message: 'Fetch CommonQuestion successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = [
                'title' => $dataRequest->title,
                'description' => $dataRequest->description,
                'image' => upload_image(image: $dataRequest->image, folder: 'commonQuestion'),
            ];
            $commonQuestion = CommonQuestion::create($data);
            return new DataSuccess(
                data: new CommonQuestionResource($commonQuestion),
                status: true,
                message: 'CommonQuestion created successfully'
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
            $commonQuestion = CommonQuestion::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $data['title'] = $dataRequest->title;
            $data['description'] = $dataRequest->description;
            if ($dataRequest->image) {
                if ($commonQuestion->image) {
                    delete_image(old_image_path: $commonQuestion->image, disk: 'public');
                }
                $data['image'] = upload_image(image: $dataRequest->image, folder: 'commonQuestion');
            }
            $commonQuestion->update($data);
            return new DataSuccess(
                data: new CommonQuestionResource($commonQuestion),
                status: true,
                message: 'CommonQuestion updated successfully'
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
            $commonQuestion = CommonQuestion::whereId($request->id)->first();
            if (!$commonQuestion) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'CommonQuestion not found'
                );
            }
            if ($commonQuestion->image) {
                delete_image(old_image_path: $commonQuestion->image, disk: 'public');
            }
            $commonQuestion->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'CommonQuestion deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'CommonQuestion deletion failed: ' . $e->getMessage()
            );
        }
    }
}
