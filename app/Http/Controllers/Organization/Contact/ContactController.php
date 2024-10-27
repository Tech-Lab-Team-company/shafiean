<?php

namespace App\Http\Controllers\Organization\Contact;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Contact\ContactService;

class ContactController extends Controller
{


    public function __construct(protected ContactService $contactService) {}

    public function index()
    {
        return $this->contactService->index()->response();
    }
}
