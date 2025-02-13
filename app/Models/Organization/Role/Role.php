<?php

namespace App\Models\Organization\Role;


use Illuminate\Support\Facades\Auth;
use Laratrust\Models\Role as RoleModel;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends RoleModel
{
    public $guarded = [];
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
    // protected static function booted(): void
    // {
    //     if (Auth::check()) {
    //         static::addGlobalScope(new PerOrganizationScope);
    //     } else {
    //         static::addGlobalScope(new PerOrganizationWebsiteScope);
    //     }
    //     // static::addGlobalScope(new PerOrganizationScope);
    // }

    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
