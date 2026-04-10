<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('provider')->default('yookassa');
            $table->string('provider_payment_id')->nullable()->unique(); // YooKassa payment ID
            $table->string('provider_status')->nullable();               // pending, waiting_for_capture, succeeded, canceled
            $table->string('internal_status')->default('pending');       // pending, processing, succeeded, failed, refunded
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('RUB');
            $table->string('confirmation_url')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('provider_response')->nullable();               // raw response snapshot
            $table->timestamps();

            $table->index('order_id');
            $table->index('provider_payment_id');
            $table->index('internal_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
