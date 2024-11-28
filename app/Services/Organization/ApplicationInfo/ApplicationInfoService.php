<?php

namespace App\Services\Organization\ApplicationInfo;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Models\ApplicationInfo\ApplicationInfo;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Http\Resources\Organization\ApplicationInfo\ApplicationInfoResource;

class ApplicationInfoService
{

    public function show($request)
    {

        $appInfo = ApplicationInfo::whereType($request->type)->firstOrNew();
        return new DataSuccess(
            data: ApplicationInfoResource::make($appInfo),
            statusCode: 200,
            message: 'Fetch Application info successfully'
        );
    }
    public function store($dataRequest): DataStatus
    {
        try {
            $appInfo = ApplicationInfo::updateOrCreate(['type' => $dataRequest->type], [
                'description' => $dataRequest->description,
                'android_url' => $dataRequest->android_url,
                'ios_url' => $dataRequest->ios_url,
                'image' => upload_image($dataRequest->image, 'appinfo'),
                'type' => $dataRequest->type
            ]);
            return new DataSuccess(
                data: new ApplicationInfoResource($appInfo),
                status: true,
                message: 'Application info created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
