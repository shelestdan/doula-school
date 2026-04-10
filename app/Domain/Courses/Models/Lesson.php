<?php

namespace App\Domain\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'module_id', 'course_id', 'title', 'description',
        'video_url', 'video_duration', 'content',
        'sort_order', 'is_preview', 'is_published',
        'attachments',
    ];

    protected $casts = [
        'is_preview'    => 'boolean',
        'is_published'  => 'boolean',
        'attachments'   => 'array',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }
}
