<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\Courses\Models\Course;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Actions\CreateOrderAction;
use App\Domain\Payments\Actions\InitiateYooKassaPaymentAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(
        Request $request,
        CreateOrderAction $createOrder,
        InitiateYooKassaPaymentAction $initiatePayment
    ): JsonResponse {
        $data = $request->validate([
            'course_slug' => ['required', 'string', 'exists:courses,slug'],
        ]);

        $course = Course::published()->where('slug', $data['course_slug'])->firstOrFail();

        if ($request->user()->hasAccessToCourse($course->id)) {
            return response()->json(['message' => 'Доступ к курсу уже есть.'], 409);
        }

        $order   = $createOrder->execute($request->user(), $course);
        $payment = $initiatePayment->execute($order);

        return response()->json([
            'order_uuid'       => $order->uuid,
            'confirmation_url' => $payment->confirmation_url,
        ], 201);
    }

    public function show(Request $request, string $uuid): JsonResponse
    {
        $order = Order::where('uuid', $uuid)->where('user_id', $request->user()->id)->firstOrFail();
        $order->load(['course', 'payments']);
        return response()->json($order);
    }
}
