<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurriculumDisabilityType extends Model
{
    use HasFactory;
    protected $table = "curriculum_disability_types";

    protected $fillable = [
        'disability_type_id',
        'curriculum_id'
    ];

    public function curriculum() :HasMany
    {
        return $this->hasMany('Curriculum', 'curriculum_id');
    }

    public function disability_type() :HasMany
    {
        return $this->hasMany('DisabilityType', 'disability_type_id');
    }


}

