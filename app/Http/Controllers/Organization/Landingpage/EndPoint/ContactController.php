<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Landingpage\EndPoint\Contact\AddContactRequest;
use App\Services\Organization\Landingpage\EndPoint\Contact\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contact_service;

    public function __construct(ContactService $contact_service)
    {
        $this->contact_service = $contact_service;
    }

    public function landing_page_add_contact(AddContactRequest $request)
    {
        return $this->contact_service->landing_page_add_contact($request)->response();
    }
}
