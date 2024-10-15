<?php

namespace App\Services\Organization\Landingpage\EndPoint\Contact;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Landingpage\EndPoint\Contact\ContactResource;
use App\Models\Organization\Landingpage\Contact;

class ContactService
{

    public function landing_page_add_contact($request): DataStatus
    {

        try {
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['message'] = $request->message;

            $contact = Contact::create($data);

            return new DataSuccess(
                status: true,
                message: 'تم الارسال بنجاح',
                data: new ContactResource($contact)
            );
        } catch (\Exception $e) {

            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
