<?php

namespace App\Services\Organization\EndPoint\Group;

use Exception;
use App\Models\Group;
use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\MiniUserResource;
use App\Http\Resources\Organization\EndPoint\Group\FetchGroupResource;
use App\Models\User;

class FetchGroupStudentService
{
    public function fetchGroupStudent($dataRequest)
    {
        try {
            $query = User::whereHas('subscriptions', function ($query) use ($dataRequest) {
                $query->where('group_id', $dataRequest->group_id)
                    ->where('course_id', $dataRequest->course_id);
            });
            $users = $query->when($dataRequest->has('word'), function ($q) use ($dataRequest) {
                return $q->where('name', 'like', '%' . $dataRequest->word . '%');
            });
            $data = $users->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: MiniUserResource::collection($data)->response()->getData(true),
                status: true,
                message: 'Fetch Users successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
