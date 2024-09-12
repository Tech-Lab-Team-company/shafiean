<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDisabilityType extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "course_disability_types";
}
