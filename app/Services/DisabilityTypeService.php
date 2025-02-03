<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\DisabilityTypeResource;
use App\Models\DisabilityType;
use Exception;

class DisabilityTypeService
{
    public function getAll($request): DataStatus
    {
        try {
            if (isset($request->word)) {
                $disabilityTypes = DisabilityType::where('title', 'like', '%' . $request->word . '%')->orderBy('id', 'desc')->paginate(10)->withQueryString();
            } else {
                $disabilityTypes = DisabilityType::orderBy('id', 'desc')->paginate(10)->withQueryString();
            }
            return new DataSuccess(
                data: DisabilityTypeResource::collection($disabilityTypes)->response()->getData(true),
                status: true,
                message: 'Disability types retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Failed to retrieve disability types: ' . $e->getMessage()
            );
        }
    }

    public function getById($request): DataStatus
    {
        try {
            $disabilityType = DisabilityType::find($request->id);
            return new DataSuccess(
                data: new DisabilityTypeResource($disabilityType),
                statusCode: 200,
                message: 'Disability type retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Disability type not found: ' . $e->getMessage()
            );
        }
    }

    public function create($request): DataStatus
    {
        try {
            if ($request->hasFile('image')) {
                $image = upload_image($request->file('image'), 'disability_types');
                $data['image'] = $image;
            }
            if (isset($request->order)) {
                $disabilityTypes = DisabilityType::where('order', '>=', $request->order)->get();
                foreach ($disabilityTypes as $disabilityType) {
                    $disabilityType->update([
                        'order' => $disabilityType->order + 1
                    ]);
                }
            }
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['order'] = $request->order;
            $disabilityType = DisabilityType::create($data);
            return new DataSuccess(
                data: new DisabilityTypeResource($disabilityType),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Disability type creation failed: ' . $e->getMessage()
            );
        }
    }

    public function update($request): DataStatus
    {
        try {
            $disability = DisabilityType::find($request->id);
            // dd($disabilityType);
            if ($request->hasFile('image')) {
                if ($disability->image !== null) {
                    delete_image($disability->image);
                }
                $image = upload_image($request->file('image'), 'disability_types');
                $data['image'] = $image;
            }
            if (isset($request->order)) {
                $disabilityTypes = DisabilityType::where('order', '>=', $request->order)->get();
                foreach ($disabilityTypes as $disabilityType) {
                    $disabilityType->update([
                        'order' => $disabilityType->order + 1
                    ]);
                }
                $data['order'] = $request->order ?? $disability->order;
            }
            $data['title'] = $request->title ?? $disability->title;
            $data['description'] = $request->description ?? $disability->description;
            $disability->update($data);
            return new DataSuccess(
                data: new DisabilityTypeResource($disability),
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Disability type update failed: ' . $e->getMessage()
            );
        }
    }

    public function delete($request): DataStatus
    {
        try {
            $disabilityType = DisabilityType::find($request->id);

            $disabilityType->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: true,
                message: 'Disability type deletion failed: ' . $e->getMessage()
            );
        }
    }
}
