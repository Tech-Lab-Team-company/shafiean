<?php

namespace App\Models\Organization\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'blogs';
    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }
    public function blogHashtagRelations(): BelongsToMany
    {
        return $this->belongsToMany(BlogHashtag::class, 'blog_hashtag_relations', 'blog_id', 'blog_hashtag_id')->withTimestamps();
    }
    public function blogCategoryRelations(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_relations', 'blog_id', 'blog_category_id')->withTimestamps();
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
