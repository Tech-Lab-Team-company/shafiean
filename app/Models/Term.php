<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'timestamp',
        'type',
        'order',
        'curriculum_id',
        'disability_type_id',
    ];

    protected $table = 'terms';

    public $timestamps = true;

    public function curriculum() :BelongsTo
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function disabilityType() :BelongsTo
    {
        return $this->belongsTo(DisabilityType::class, 'disability_type_id');
    }
}

