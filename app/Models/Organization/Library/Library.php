<?php

namespace App\Models\Organization\Library;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'libraries';
    protected $appends  = ["file_link"];

    public function getFileLinkAttribute()
    {
        return $this->file ? url('storage/' . $this->file) : '';
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
