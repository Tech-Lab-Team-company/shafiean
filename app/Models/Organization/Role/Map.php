<?php

namespace App\Models\Organization\Role;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Map extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'maps';
    // protected static function booted(): void
    // {
    //     if (Auth::check()) {
    //         static::addGlobalScope(new PerOrganizationScope);
    //     } else {
    //         static::addGlobalScope(new PerOrganizationWebsiteScope);
    //     }
    //     // static::addGlobalScope(new PerOrganizationScope);
    // }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::observe(OrganizationIdObserver::class);
    // }
}
