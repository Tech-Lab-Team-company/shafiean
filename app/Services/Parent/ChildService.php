<?php


namespace App\Services\Parent;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Parent\Child\ChildResource;
use App\Http\Resources\Parent\Exam\FetchChildExamResource;

class ChildService
{
    public function academic_report($request) : DataStatus
     {
        try{
            $parent = auth()->guard('user')->user();
            $children = $parent->childs;
            // dd($children);
            return new DataSuccess(
                data: ChildResource::collection($children),
                status: true,
                message: 'success',
            );
        }catch(\Exception $e){
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function exam_report($request) : DataStatus
     {
        try{
            $parent = auth()->guard('user')->user();
            $children = $parent->childs;
            // dd($children);
            return new DataSuccess(
                data: FetchChildExamResource::collection($children),
                status: true,
                message: 'success',
            );
        }catch(\Exception $e){
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
