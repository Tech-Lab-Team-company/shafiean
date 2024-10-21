<?php
namespace App\Http\Controllers\User\LibraryCategory;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\JobType\FetchJobTypeService;
use App\Services\Organization\EndPoint\LibraryCategory\FetchLibraryCategoryService;

class FetchLibraryCategoryController extends Controller
{
    public function __construct(protected FetchLibraryCategoryService $fetchLibraryCategoryService) {}
    public function fetchLibraryCategory()
    {
        return $this->fetchLibraryCategoryService->fetchLibraryCategory()->response();
    }
}
