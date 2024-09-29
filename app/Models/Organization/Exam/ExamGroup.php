<?php

namespace App\Models\Organization\Exam;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamGroup extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'exam_groups';
    protected $gurded = [];

}
