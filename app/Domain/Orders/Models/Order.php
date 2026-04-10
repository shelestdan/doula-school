<?php

namespace App\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Domain\Courses\Models\Course;
use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Str;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'user_id', 'course_id',
        'status', 'amount', 'currency',
        'promo_code', 'discount', 'notes',
        'paid_at',
    ];

    protected $casts = [
        'amount'   => 'decimal:2',
        'discount' => 'decimal:2',
        'paid_at'  => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->uuid)) {
                $order->uuid = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment(): HasMany
    {
        return $this->hasMany(Payment::class)->latestOfMany();
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function totalAfterDiscount(): float
    {
        return max(0, $this->amount - $this->discount);
    }
}
