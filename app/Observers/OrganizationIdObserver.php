<?php

namespace App\Observers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class OrganizationIdObserver
{
    public function creating(Model $model)
    {
        $table = $model->getTable();
        if (Schema::hasColumn($table, 'organization_id')) {
            if (auth('organization')->check()) {
                $model->organization_id =  get_organization_id(auth('organization')->user());
            }
        }
    }
}
