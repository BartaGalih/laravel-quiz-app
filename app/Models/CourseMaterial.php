<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'type',
        'file_path',
        'video_url',
        'page_count',
        'duration_seconds',
        'sort_order',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(MaterialProgress::class);
    }

    // Human-readable duration (e.g. "09:42 minutes")
    public function getFormattedDurationAttribute(): string
    {
        if (!$this->duration_seconds) return '';
        $m = floor($this->duration_seconds / 60);
        $s = $this->duration_seconds % 60;
        return sprintf('%02d:%02d minutes', $m, $s);
    }
}
