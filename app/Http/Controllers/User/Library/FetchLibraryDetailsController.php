<?php

namespace App\Http\Controllers\User\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Library\FetchLibraryDetailsService;
use App\Http\Requests\User\Library\UserFetchLibraryDetailsRequest;

class FetchLibraryDetailsController extends Controller
{
    public function __construct(protected  FetchLibraryDetailsService $fetchLibraryDetailsService) {}
    public function show(UserFetchLibraryDetailsRequest $request)
    {
        return $this->fetchLibraryDetailsService->show($request)->response();
    }
}
