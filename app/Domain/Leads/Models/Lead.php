<?php

namespace App\Domain\Leads\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Lead extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'city', 'message', 'source',
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term',
        'status', 'assigned_to', 'tags', 'notes',
        'course_id', 'service_id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(LeadNote::class)->orderByDesc('created_at');
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
