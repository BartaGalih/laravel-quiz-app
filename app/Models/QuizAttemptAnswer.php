<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttemptAnswer extends Model
{
    protected $fillable = ['quiz_attempt_id', 'question_id', 'question_option_id', 'is_flagged'];

    protected function casts(): array
    {
        return ['is_flagged' => 'boolean'];
    }

    public function attempt(): BelongsTo { return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id'); }
    public function question(): BelongsTo { return $this->belongsTo(Question::class); }
    public function option(): BelongsTo { return $this->belongsTo(QuestionOption::class, 'question_option_id'); }
}
