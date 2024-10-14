<?php

namespace App\Http\Controllers\Organization\Landingpage;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Policy\PolicyService;
use App\Http\Requests\Organization\Landingpage\Policy\StorePolicyRequest;
use App\Http\Requests\Organization\Landingpage\Policy\DeletePolicyRequest;
use App\Http\Requests\Organization\Landingpage\Policy\UpdatePolicyRequest;
use App\Http\Requests\Organization\Landingpage\Policy\FetchPolicyDetailsRequest;

class PolicyController extends Controller
{
    public function __construct(protected  PolicyService $policyService) {}
    public function index()
    {
        return $this->policyService->index()->response();
    }
    public function show(FetchPolicyDetailsRequest $request)
    {
        return $this->policyService->show($request)->response();
    }
    public function store(StorePolicyRequest $request)
    {
        return $this->policyService->store($request)->response();
    }
}
