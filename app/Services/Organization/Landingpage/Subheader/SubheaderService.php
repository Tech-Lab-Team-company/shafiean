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
            // dd($request->features);
            foreach ($request->features as $featureData) {
                $feature_data = []; // Initialize empty array
                // dd($featureData->title);
                // If the feature image is part of a file input, handle it correctly
                if (isset($featureData['image']) && is_file($featureData['image'])) {
                    $feature_data['image'] = upload_image($featureData['image'], 'organizations/landingpage/subheader/feature');
                }
                $subheader->features()->create([
                    'title' => $featureData['title'],
                    'description' => $featureData['description'],
                    'image' => $feature_data['image'] ?? null,
                    'color' => $featureData['color'] ?? null,
                    'featurable_type' => Subheader::class,
                    'featurable_id' => $subheader->id
                ]);
            }

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
            // dd($request->id);
            $subheader = Subheader::find($request->id);
            // dd($subheader);
            $data['title'] = $request->title ?? $subheader->title;
            $data['subtitle'] = $request->subtitle ?? $subheader->subtitle;
            $data['description'] = $request->description ?? $subheader->description;
            if ($request->hasFile('image')) {
                delete_image($subheader->image);
                $data['image'] = upload_image($request->file('image'), 'organizations/landingpage/subheader');
            }
            $subheader->update($data);

            if (isset($request->features)) {
                $subheader->features()->delete();
                foreach ($request->features as $featureData) {
                    $feature_data = []; // Initialize empty array
                    // If the feature image is part of a file input, handle it correctly
                    if (isset($featureData['image']) && is_file($featureData['image'])) {
                        $feature_data['image'] = upload_image($featureData['image'], 'organizations/landingpage/subheader/feature');
                    }
                    $subheader->features()->create([
                        'title' => $featureData['title'],
                        'description' => $featureData['description'],
                        'image' => $feature_data['image'] ?? null,
                        'color' => $featureData['color'] ?? null,
                        'featurable_type' => Subheader::class,
                        'featurable_id' => $subheader->id
                    ]);
                }
            }

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
            if ($subheader->image != null) {

                delete_image($subheader->image);
            }
            foreach ($subheader->features as $feature) {
                if ($feature->image != null) {
                    delete_image($feature->image);
                }
            }
            $subheader->features()->delete();
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
