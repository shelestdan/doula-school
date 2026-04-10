<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Facades\Log;
use YooKassa\Client;

class InitiateYooKassaPaymentAction
{
    public function execute(Order $order): Payment
    {
        $client = new Client();
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        $idempotenceKey = 'order-' . $order->uuid;

        try {
            $response = $client->createPayment([
                'amount'       => [
                    'value'    => number_format($order->totalAfterDiscount(), 2, '.', ''),
                    'currency' => $order->currency,
                ],
                'confirmation' => [
                    'type'       => 'redirect',
                    'return_url' => route('checkout.success', $order->uuid),
                ],
                'capture'     => true,
                'description' => "Оплата курса (заказ {$order->uuid})",
                'metadata'    => [
                    'order_uuid' => $order->uuid,
                    'order_id'   => $order->id,
                    'user_id'    => $order->user_id,
                    'course_id'  => $order->course_id,
                ],
            ], $idempotenceKey);

            $order->update(['status' => 'awaiting_payment']);

            return Payment::create([
                'order_id'            => $order->id,
                'provider'            => 'yookassa',
                'provider_payment_id' => $response->getId(),
                'provider_status'     => $response->getStatus(),
                'internal_status'     => 'pending',
                'amount'              => $order->totalAfterDiscount(),
                'currency'            => $order->currency,
                'confirmation_url'    => $response->getConfirmation()->getConfirmationUrl(),
                'provider_response'   => json_decode(json_encode($response->jsonSerialize()), true),
            ]);
        } catch (\Throwable $e) {
            Log::error('YooKassa create payment failed', [
                'order_uuid' => $order->uuid,
                'error'      => $e->getMessage(),
            ]);

            $order->update(['status' => 'canceled']);

            return Payment::create([
                'order_id'        => $order->id,
                'provider'        => 'yookassa',
                'internal_status' => 'failed',
                'amount'          => $order->totalAfterDiscount(),
                'currency'        => $order->currency,
            ]);
        }
    }
}
