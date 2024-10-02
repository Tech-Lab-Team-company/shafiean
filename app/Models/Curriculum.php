<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "curriculums";

    protected $guarded = [];
    public function stages():HasMany{
        return $this->hasMany(Stage::class,'curriculum_id','id');
    }

}

