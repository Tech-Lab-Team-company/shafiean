<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    use HasFactory;
    protected $table = "stage";

    protected $fillable = [
        'title',
        'type',
        'order',
        'organization_id',
        'disability_type_id'
    ];

    public function curriculum() :HasMany
    {
        return $this->hasMany('Curriculum', 'curriculum_id');
    }

}


