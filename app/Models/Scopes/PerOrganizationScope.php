<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class PerOrganizationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // $builder->where('organization_id', auth('organization')?->user()?->organization_id);
        $table = $model->getTable();
        if (Schema::hasColumn($table, 'organization_id')) {
            $builder->where($model . '.organization_id', get_auth_organization_id());
        }
    }
}
