<?php

namespace App\Domain\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Course extends Model implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'short_desc', 'description',
        'cover', 'video_preview_url',
        'price', 'old_price', 'currency',
        'access_type', 'access_days',
        'level', 'duration_hours', 'lessons_count',
        'what_you_learn', 'requirements', 'includes',
        'is_published', 'is_featured', 'sort_order',
        'badge',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description', 'og_image',
    ];

    protected $casts = [
        'what_you_learn' => 'array',
        'requirements'   => 'array',
        'includes'       => 'array',
        'is_published'   => 'boolean',
        'is_featured'    => 'boolean',
        'price'          => 'decimal:2',
        'old_price'      => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('sort_order');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('sort_order');
    }

    public function accessGrants(): HasMany
    {
        return $this->hasMany(CourseAccessGrant::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function hasDiscount(): bool
    {
        return $this->old_price && $this->old_price > $this->price;
    }

    public function discountPercent(): int
    {
        if (! $this->hasDiscount()) {
            return 0;
        }

        return (int) round((1 - $this->price / $this->old_price) * 100);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
    }
}
