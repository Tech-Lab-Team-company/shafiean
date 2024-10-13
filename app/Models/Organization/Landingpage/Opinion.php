<?php

namespace App\Models\Organization\Landingpage;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opinion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new PerOrganizationScope);
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
