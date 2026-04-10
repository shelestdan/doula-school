<?php

namespace App\Domain\Payments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentEvent extends Model
{
    protected $fillable = [
        'payment_id', 'provider', 'event_type',
        'provider_payment_id', 'payload',
        'processing_status', 'processing_error',
        'received_at', 'processed_at',
    ];

    protected $casts = [
        'payload'      => 'array',
        'received_at'  => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function markProcessed(): void
    {
        $this->update([
            'processing_status' => 'processed',
            'processed_at'      => now(),
        ]);
    }

    public function markFailed(string $error): void
    {
        $this->update([
            'processing_status' => 'failed',
            'processing_error'  => $error,
            'processed_at'      => now(),
        ]);
    }
}
