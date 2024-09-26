<?php

namespace App\Models\Organization\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogHashtag extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'blog_hashtags';
    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
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
