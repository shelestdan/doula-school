<?php

namespace App\Domain\Payments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Orders\Models\Order;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'provider',
        'provider_payment_id', 'provider_status', 'internal_status',
        'amount', 'currency',
        'confirmation_url', 'paid_at',
        'provider_response',
    ];

    protected $casts = [
        'amount'            => 'decimal:2',
        'paid_at'           => 'datetime',
        'provider_response' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(PaymentEvent::class);
    }

    public function isSucceeded(): bool
    {
        return $this->internal_status === 'succeeded';
    }

    public function scopePending($query)
    {
        return $query->where('internal_status', 'pending');
    }

    public function scopeSucceeded($query)
    {
        return $query->where('internal_status', 'succeeded');
    }
}
