<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->nullable()->constrained()->nullOnDelete();
            $table->string('provider')->default('yookassa');
            $table->string('event_type');                   // e.g. payment.succeeded, payment.canceled
            $table->string('provider_payment_id')->nullable();
            $table->json('payload');                        // full webhook payload
            $table->string('processing_status')->default('pending'); // pending, processed, failed
            $table->text('processing_error')->nullable();
            $table->timestamp('received_at');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index('provider_payment_id');
            $table->index('event_type');
            $table->index('processing_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_events');
    }
};
