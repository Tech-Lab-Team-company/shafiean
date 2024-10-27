<?php

namespace App\Http\Controllers\User\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Contact\UserContactService;
use App\Http\Requests\User\Contact\UserAddContactRequest;

class UserContactController extends Controller
{
    public function __construct(protected UserContactService $userContactService) {}

    public function store(UserAddContactRequest $request)
    {
        return $this->userContactService->store($request->validated())->response();
    }
}
