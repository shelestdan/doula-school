<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Models\PaymentEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HandleYooKassaWebhookAction
{
    public function __construct(
        private readonly ConfirmOrderPaidAction $confirmOrderPaid
    ) {}

    public function execute(array $payload): void
    {
        $eventType         = $payload['event'] ?? null;
        $providerPaymentId = $payload['object']['id'] ?? null;

        if (! $providerPaymentId || ! $eventType) {
            Log::warning('YooKassa webhook: missing event or payment ID', $payload);
            return;
        }

        // Find payment; null is ok — we'll log the event anyway
        $payment = Payment::where('provider_payment_id', $providerPaymentId)->first();

        // Idempotency: skip if already processed
        $existing = PaymentEvent::where('provider_payment_id', $providerPaymentId)
            ->where('event_type', $eventType)
            ->where('processing_status', 'processed')
            ->first();

        if ($existing) {
            return;
        }

        $event = PaymentEvent::create([
            'payment_id'          => $payment?->id,
            'provider'            => 'yookassa',
            'event_type'          => $eventType,
            'provider_payment_id' => $providerPaymentId,
            'payload'             => $payload,
            'processing_status'   => 'pending',
            'received_at'         => now(),
        ]);

        try {
            DB::transaction(function () use ($event, $eventType, $payment, $payload) {
                match ($eventType) {
                    'payment.succeeded' => $this->handleSucceeded($payment, $payload),
                    'payment.canceled'  => $this->handleCanceled($payment, $payload),
                    default             => null,
                };
                $event->markProcessed();
            });
        } catch (\Throwable $e) {
            $event->markFailed($e->getMessage());
            throw $e;
        }
    }

    private function handleSucceeded(?Payment $payment, array $payload): void
    {
        if (! $payment) {
            Log::error('YooKassa payment.succeeded: payment not found', $payload);
            return;
        }

        $payment->update([
            'provider_status'   => 'succeeded',
            'internal_status'   => 'succeeded',
            'paid_at'           => now(),
            'provider_response' => $payload,
        ]);

        $this->confirmOrderPaid->execute($payment->order);
    }

    private function handleCanceled(?Payment $payment, array $payload): void
    {
        if (! $payment) {
            return;
        }

        $payment->update([
            'provider_status' => 'canceled',
            'internal_status' => 'failed',
        ]);

        $payment->order?->update(['status' => 'canceled']);
    }
}
