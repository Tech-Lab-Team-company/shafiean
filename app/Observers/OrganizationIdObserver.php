<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class OrganizationIdObserver
{
    public function creating(Model $model)
    {
        if (auth('organization')->check()) {
            $model->organization_id =  get_organization_id(auth('organization')->user());
        }
    }
}
