<?php

namespace App\Services\User\Contact;


use App\Models\Course;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Contact;
use App\Http\Resources\User\Contact\UserContactResource;

class UserContactService
{
    public function store($dataRequest): DataStatus
    {
        try {
            $contact = Contact::create($dataRequest);
            return new DataSuccess(
                data: new UserContactResource($contact),
                status: true,
                message: 'Message Sent Successfully'
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
