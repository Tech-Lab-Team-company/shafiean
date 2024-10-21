<?php
namespace App\Http\Controllers\User\Library;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Library\FetchLibraryByCategoryIdRequest;
use App\Services\Organization\EndPoint\Library\FetchLibraryService;
use App\Services\Organization\EndPoint\LibraryCategory\FetchLibraryCategoryService;

class FetchLibraryController extends Controller
{
    public function __construct(protected FetchLibraryService $fetchLibraryService) {}
    public function fetchLibraryByCategoryId(FetchLibraryByCategoryIdRequest $request)
    {
        return $this->fetchLibraryService->fetchLibraryByCategoryId($request)->response();
    }
}
