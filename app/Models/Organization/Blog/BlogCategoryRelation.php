<?php

namespace App\Models\Organization\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategoryRelation extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'blog_category_relations';

}
