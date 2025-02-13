<?php

namespace App\Models\Organization\Role;


use Illuminate\Support\Facades\Auth;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Organization\Role\MapPermission;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    public $guarded = [];
    public function mapPermissions()
    {
        return $this->hasMany(MapPermission::class);
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
