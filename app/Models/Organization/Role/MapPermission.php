<?php

namespace App\Models\Organization\Role;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapPermission extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'map_permission';
    // public  $timestamps = false;
}
