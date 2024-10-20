<?php

namespace App\Models\Organization\Exam;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization\Answer\Answer;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization\Question\Question;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamResultAnswer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "exam_result_answers";
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function examResult(): BelongsTo
    {
        return $this->belongsTo(ExamResult::class, "exam_result_id", "id");
    }
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, "question_id", "id");
    }
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, "answer_id", "id");
    }
}
