<?php

namespace App\Models\Organization\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroup extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_groups';
    protected $guarded = [];
}
