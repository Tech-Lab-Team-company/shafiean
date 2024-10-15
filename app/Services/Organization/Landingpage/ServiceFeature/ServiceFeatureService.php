<?php

namespace App\Services\Organization\Landingpage\ServiceFeature;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Landingpage\ServiceFeature\ServiceFeatureResource;
use App\Models\Organization\Landingpage\ServiceFeature;

class ServiceFeatureService
{

    public function organization_fetch_service_features($request): DataStatus
    {
        try {

            $service_features = ServiceFeature::get();

            return new DataSuccess(
                status: true,
                data: ServiceFeatureResource::collection($service_features),
                message: 'Get Service Feature Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_fetch_service_feature_details($request): DataStatus
    {
        try {

            $service_feature = ServiceFeature::where('id', $request->id)->first();

            return new DataSuccess(
                status: true,
                data: new ServiceFeatureResource($service_feature),
                message: 'Get Service Feature Success'
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function organization_add_service_feature($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['subtitle'] = $request->subtitle;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/service_feature');
            }
            $service_feature = ServiceFeature::create($data);

            foreach ($request->features as $featureData) {
                $feature_data = []; // Initialize empty array
                // dd($featureData->title);
                // If the feature image is part of a file input, handle it correctly
                if (isset($featureData['image']) && is_file($featureData['image'])) {
                    $feature_data['image'] = upload_image($featureData['image'], 'organizations/landingpage/service_feature/feature');
                }

                $service_feature->features()->create([
                    'title' => $featureData['title'],
                    'description' => $featureData['description'],
                    'image' => $feature_data['image'] ?? null,
                    'color' => $featureData['color'] ?? null,
                    'featurable_type' => ServiceFeature::class,
                    'featurable_id' => $service_feature->id
                ]);
            }

            return new DataSuccess(
                status: true,
                data: new ServiceFeatureResource($service_feature),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function organization_edit_service_feature($request): DataStatus
    {
        try {
            $service_feature = ServiceFeature::where('id', $request->id)->first();
            $data['title'] = $request->title;
            $data['subtitle'] = $request->subtitle;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                if ($service_feature->image != null) {

                    delete_image($service_feature->image);
                }
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/service_feature');
            }
            $service_feature->update($data);
            $service_feature->features()->delete();
            foreach ($request->features as $featureData) {
                $feature_data = []; // Initialize empty array
                // If the feature image is part of a file input, handle it correctly
                if (isset($featureData['image']) && is_file($featureData['image'])) {
                    if ($service_feature->image != null) {

                        delete_image($service_feature->image);
                    }
                    $feature_data['image'] = upload_image($featureData['image'], 'organizations/landingpage/service_feature/feature');
                }
                $service_feature->features()->create([
                    'title' => $featureData['title'],
                    'description' => $featureData['description'],
                    'image' => $feature_data['image'] ?? null,
                    'color' => $featureData['color'] ?? null,
                    'featurable_type' => ServiceFeature::class,
                    'featurable_id' => $service_feature->id
                ]);
            }
            return new DataSuccess(
                status: true,
                data: new ServiceFeatureResource($service_feature),
                message: 'Get Header Success'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage(),
                errors: [$e->getTraceAsString()]
            );
        }
    }
    public function organization_delete_service_feature($request): DataStatus
    {
        try {
            $service_feature = ServiceFeature::where('id', $request->id)->first();
            if ($service_feature->image != null) {
                delete_image($service_feature->image);
            }
            foreach ($service_feature->features as $feature) {
                if ($feature->image != null) {
                    delete_image($feature->image);
                }
            }
            $service_feature->features()->delete();
            $service_feature->delete();
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
