<?php

namespace App\Services\Organization\Contact;


use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Landingpage\EndPoint\Contact\ContactResource;
use App\Models\Organization\Landingpage\Contact;

class ContactService
{

    public function index(): DataStatus
    {
        try {
            $contacts = Contact::get();
            return new DataSuccess(
                status: true,
                message: 'Contacts fetched successfully',
                data: ContactResource::collection($contacts)
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
