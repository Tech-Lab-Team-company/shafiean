<?php

namespace App\Http\Controllers\User\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Library\FetchLibraryDetailsService;
use App\Http\Requests\Organization\Library\FetchLibraryDetailsRequest;

class FetchLibraryDetailsController extends Controller
{
    public function __construct(protected  FetchLibraryDetailsService $fetchLibraryDetailsService) {}
    public function show(FetchLibraryDetailsRequest $request)
    {
        return $this->fetchLibraryDetailsService->show($request)->response();
    }
}
