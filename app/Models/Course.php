<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "courses";


    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function disability_types()
    {
        return $this->belongsToMany(DisabilityType::class, 'course_disability_types', 'course_id', 'disability_type_id');
    }

    public function stages()
    {

        return $this->belongsToMany(Stage::class, 'course_stages', 'course_id', 'stage_id')->withTimestamps();
    }
}
