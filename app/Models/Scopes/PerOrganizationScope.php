<?php

namespace App\Models\Scopes;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PerOrganizationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $table = $model->getTable();
        /* $organization_id = null;
        if(FacadesAuth::check()){
            $organization_id = get_auth_organization_id();
            }else{
                $organization_id = get_organization_id_for_website(request());
        } */
        if (Schema::hasColumn($table, 'organization_id') && !auth('admin')->check()) {
            $builder->where('organization_id', get_auth_organization_id());
        }
    }
}
