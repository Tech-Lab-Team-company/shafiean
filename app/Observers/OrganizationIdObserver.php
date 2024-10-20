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
            if (auth()->check()) {
                $model->organization_id =  get_auth_organization_id();
            }
        }
    }
}
