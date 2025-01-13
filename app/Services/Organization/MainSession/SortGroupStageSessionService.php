<?php

namespace App\Services\Organization\MainSession;


use Exception;
use App\Models\Group;
use App\Models\Course;
use App\Models\GroupStage;
use App\Models\MainSession;
use App\Enum\SessionIsNewEnum;
use App\Models\GroupStageSession;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\MainSessionResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionIndexForGroupResource;

class SortGroupStageSessionService
{
    public function sort($dataRequest): DataStatus
    {
        try {
            GroupStageSession::where('id', $dataRequest->id)->update(['order_by' => $dataRequest->order_by]);
            return new DataSuccess(
                status: true,
                message: 'تم الترتيب بنجاح'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
