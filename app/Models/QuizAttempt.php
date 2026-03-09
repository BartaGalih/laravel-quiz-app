<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id', 'quiz_id', 'score', 'correct_answers',
        'total_questions', 'is_passed', 'started_at', 'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'is_passed'    => 'boolean',
            'started_at'   => 'datetime',
            'submitted_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function quiz(): BelongsTo { return $this->belongsTo(Quiz::class); }
    public function answers(): HasMany { return $this->hasMany(QuizAttemptAnswer::class); }
}
