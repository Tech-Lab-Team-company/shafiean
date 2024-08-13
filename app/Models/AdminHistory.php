<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'creatable_type', 'editable_type', 'model_id', 'type', 'order',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}

