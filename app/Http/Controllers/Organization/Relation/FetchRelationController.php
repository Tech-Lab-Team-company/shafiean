<?php

namespace App\Http\Controllers\Organization\Relation;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\User\FetchUserService;
use App\Services\Organization\EndPoint\Relation\FetchRelationService;

class FetchRelationController extends Controller
{
    public function __construct(protected FetchRelationService $fetchRelationService) {}
    public function __invoke()
    {
        return $this->fetchRelationService->fetchRelations()->response();
    }
}
