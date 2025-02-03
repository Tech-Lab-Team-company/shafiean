<?php

namespace App\Services\Organization\Competition;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Models\Organization\Competition\Competition;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Http\Resources\Organization\Competition\CompetitionResource;

class CompetitionService
{
    public function index($dataRequest)
    {
        try {
            $query = Competition::query();
            if (isset($dataRequest)) {
                $filter_service = new FilterService();
                $filter_service->filterCompetitions($query, $dataRequest);
            }
            $competitions = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: CompetitionResource::collection($competitions)->response()->getData(true),
                status: true,
                message: 'Competitions fetched successfully'
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
        $competition = Competition::whereId($request->id)->first();
        return new DataSuccess(
            data: new CompetitionResource($competition),
            statusCode: 200,
            message: 'Fetch Competition successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            if (isset($dataRequest['image'])) {
                $dataRequest['image'] = upload_image(folder: 'competitions', image: $dataRequest['image']);
            }
            $rewards = $dataRequest['rewards'] ?? [];
            unset($dataRequest['rewards']);
            $competition = Competition::create($dataRequest);
            if ($rewards) {
                $competition->competitionRewards()->createMany($rewards);
            }
            return new DataSuccess(
                data: new CompetitionResource($competition),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $competition = Competition::whereId($dataRequest['id'])->first();
            if (!$competition) {
                return new DataFailed(
                    status: false,
                    message: __('messages.not_found')
                );
            }
            if (isset($dataRequest['image'])) {
                if ($competition->image) {
                    delete_image(old_image_path: $competition->image, disk: 'public');
                }
                $dataRequest['image'] = uploadFile(folder: 'competitions', file: $dataRequest['image']);
            }
            $rewards = $dataRequest['rewards'] ?? [];
            unset($dataRequest['rewards']);
            $competition->update($dataRequest);
            if ($rewards) {
                $competition->competitionRewards()->delete();
                $competition->competitionRewards()->createMany($rewards);
            }
            return new DataSuccess(
                data: new CompetitionResource($competition),
                status: true,
                message: __('messages.success_update')
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
            Competition::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Competition deletion failed: ' . $e->getMessage()
            );
        }
    }
}
