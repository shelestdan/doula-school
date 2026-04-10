<?php

namespace App\Domain\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageBlock extends Model
{
    protected $fillable = [
        'page_id', 'type', 'config', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'config'       => 'array',
        'is_published' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
