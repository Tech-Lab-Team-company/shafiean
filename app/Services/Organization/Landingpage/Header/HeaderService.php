<?php

namespace App\Services\Organization\Landingpage\Header;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Models\Organization\Landingpage\Header;
use App\Http\Resources\Organization\Landingpage\Header\HeaderResource;

class HeaderService
{
    public function organization_fetch_headers($dataRequest): DataStatus
    {
        try {

            $query = Header::query();
            if (isset($dataRequest)) {
                $filter_service = new FilterService();
                $filter_service->filterHeaders($query, $dataRequest);
            }
            $headers = $query->get();
            return new DataSuccess(
                status: true,
                data: HeaderResource::collection($headers),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_fetch_header_details($request): DataStatus
    {
        try {

            $header = Header::where('id', $request->id)->first();

            return new DataSuccess(
                status: true,
                data: new HeaderResource($header),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_add_header($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['subtitle'] = $request->subtitle;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/header');
            }
            $header = Header::create($data);

            return new DataSuccess(
                status: true,
                data: new HeaderResource($header),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_edit_header($request): DataStatus
    {
        try {
            $header = Header::where('id', $request->id)->first();
            $data['title'] = $request->title ?? $header->title;
            $data['subtitle'] = $request->subtitle ?? $header->subtitle;
            $data['description'] = $request->description ?? $header->description;
            if ($request->hasFile('image')) {
                delete_image($header->image);
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/header');
            }
            $header->update($data);

            return new DataSuccess(
                status: true,
                data: new HeaderResource($header),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_delete_header($request): DataStatus
    {
        try {
            $header = Header::where('id', $request->id)->first();
            if ($header->image != null) {
                delete_image($header->image);
            }
            $header->delete();
            return new DataSuccess(
                status: true,
                message: 'Delete Header Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
