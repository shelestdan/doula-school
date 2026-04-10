<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Courses\Models\Course;
use App\Domain\Orders\Models\Order;
use App\Models\User;

class CreateOrderAction
{
    public function execute(User $user, Course $course, ?string $promoCode = null): Order
    {
        $amount   = $course->price;
        $discount = 0;

        // Promo code logic would go here
        // if ($promoCode) { ... }

        return Order::create([
            'user_id'    => $user->id,
            'course_id'  => $course->id,
            'status'     => 'pending',
            'amount'     => $amount,
            'currency'   => $course->currency ?? 'RUB',
            'promo_code' => $promoCode,
            'discount'   => $discount,
        ]);
    }
}
