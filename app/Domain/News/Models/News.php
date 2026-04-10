<?php

namespace App\Domain\News\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;

    protected $table = 'news';

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'cover',
        'author', 'category', 'tags', 'status',
        'publish_at', 'views',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description', 'og_image',
    ];

    protected $casts = [
        'tags'       => 'array',
        'publish_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('publish_at', '<=', now());
    }

    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->publish_at <= now();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
    }
}
