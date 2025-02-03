<?php

namespace App\Services\Organization\Landingpage\Feature;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Landingpage\Feature\FeatureResource;
use App\Models\Organization\Landingpage\Feature;

class FeatureService
{

    public function organization_fetch_features($request): DataStatus
    {
        try {

            $features = Feature::get();

            return new DataSuccess(
                status: true,
                data: FeatureResource::collection($features),
                message: 'Get Feature Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_fetch_feature_details($request): DataStatus
    {
        try {

            $feature = Feature::where('id', $request->id)->first();

            return new DataSuccess(
                status: true,
                data: new FeatureResource($feature),
                message: 'Get Feature Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_add_feature($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['subtitle'] = $request->subtitle;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/feature');
            }
            // $data['organization_id'] = organization_id();
            $feature = Feature::create($data);

            return new DataSuccess(
                status: true,
                data: new FeatureResource($feature),
                message: __('messages.success_create')
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_edit_feature($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['subtitle'] = $request->subtitle;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/feature');
            }
            $feature = Feature::where('id', $request->id)->update($data);

            return new DataSuccess(
                status: true,
                data: new FeatureResource($feature),
                message: __('messages.success_update')
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_delete_feature($request): DataStatus
    {
        try {
            $feature = Feature::where('id', $request->id)->delete();

            return new DataSuccess(
                status: true,
                data: new FeatureResource($feature),
                message: __('messages.success_delete')
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
