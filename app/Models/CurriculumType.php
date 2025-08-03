<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "slug",
    ];

    public function curriculum()
    {
        return $this->hasMany(Curriculum::class, 'curriculum_type_id', 'id');
    }
};
