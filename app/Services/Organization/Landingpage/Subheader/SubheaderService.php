<?php

namespace App\Services\Organization\Landingpage\Subheader;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Landingpage\Subheader\SubheaderResource;
use App\Models\Organization\Landingpage\Subheader;

class SubheaderService
{
    public function organization_fetch_subheaders($request): DataStatus
    {
        try {

            $subheaders = Subheader::get();

            return new DataSuccess(
                status: true,
                data: SubheaderResource::collection($subheaders),
                message: 'Get subheader Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_fetch_subheader_details($request): DataStatus
    {
        try {

            $subheader = Subheader::where('id', $request->id)->first();

            return new DataSuccess(
                status: true,
                data: new SubheaderResource($subheader),
                message: 'Get subheader Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_add_subheader($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['subtitle'] = $request->subtitle;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/subheader');
            }
            $subheader = Subheader::create($data);

            return new DataSuccess(
                status: true,
                data: new SubheaderResource($subheader),
                message: 'Get subheader Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_edit_subheader($request): DataStatus
    {
        try {
            $subheader = Subheader::where('id', $request->id)->first();
            $data['title'] = $request->title ?? $subheader->title;
            $data['subtitle'] = $request->subtitle ?? $subheader->subtitle;
            $data['description'] = $request->description ?? $subheader->description;
            if ($request->hasFile('image')) {
                delete_image($subheader->image);
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/subheader');
            }
            $subheader->update($data);

            return new DataSuccess(
                status: true,
                data: new SubheaderResource($subheader),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_delete_subheader($request): DataStatus
    {
        try {
            // dd($request->id);
            $subheader = Subheader::where('id', $request->id)->first();
            // dd($subheader);
            // dd(auth()->user()->organization_id);
            delete_image($subheader->image);
            $subheader->delete();
            return new DataSuccess(
                status: true,
                message: 'Delete subheader Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
