<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domain\Payments\Actions\HandleYooKassaWebhookAction;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request, HandleYooKassaWebhookAction $handler): JsonResponse
    {
        try {
            $handler->execute($request->all());
        } catch (\Throwable $e) {
            Log::error('YooKassa webhook error', [
                'message' => $e->getMessage(),
                'payload' => $request->all(),
            ]);
            // Always return 200 to prevent YooKassa retries for unrecoverable errors
        }

        return response()->json(['status' => 'ok']);
    }
}
