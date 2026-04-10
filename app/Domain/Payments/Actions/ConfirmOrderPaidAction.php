<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Courses\Actions\GrantCourseAccessAction;
use App\Domain\Orders\Models\Order;
use Illuminate\Support\Facades\Log;

class ConfirmOrderPaidAction
{
    public function __construct(
        private readonly GrantCourseAccessAction $grantAccess
    ) {}

    public function execute(Order $order): void
    {
        if ($order->status === 'paid') {
            return; // Already processed
        }

        $order->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        if (! $order->user) {
            Log::error('ConfirmOrderPaid: user not found', ['order_id' => $order->id]);
            return;
        }

        if (! $order->course) {
            Log::error('ConfirmOrderPaid: course not found', ['order_id' => $order->id]);
            return;
        }

        $this->grantAccess->execute(
            user: $order->user,
            course: $order->course,
            source: 'purchase',
            grantedBy: (string) $order->id,
            grantedByType: 'order'
        );
    }
}
