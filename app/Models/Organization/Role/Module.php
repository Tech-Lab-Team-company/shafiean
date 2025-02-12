<?php

namespace App\Models\Organization\Role;


use Illuminate\Support\Facades\Auth;
use App\Models\Organization\Role\Map;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'modules';
    public function maps()
    {
        return $this->belongsToMany(Map::class, 'map_permission', 'module_id', 'map_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'map_permission', 'module_id', 'permission_id');
    }
    public function modulePermissions():HasMany{
        return $this->hasMany(MapPermission::class,'module_id');
    }
    protected static function booted(): void
    {
        if (Auth::check()) {
            static::addGlobalScope(new PerOrganizationScope);
        } else {
            static::addGlobalScope(new PerOrganizationWebsiteScope);
        }
        // static::addGlobalScope(new PerOrganizationScope);
    }

    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
