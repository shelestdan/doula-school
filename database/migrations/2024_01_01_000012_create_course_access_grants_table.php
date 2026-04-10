<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_access_grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('granted_by_type')->nullable(); // 'order', 'admin', 'manual'
            $table->unsignedBigInteger('granted_by_id')->nullable();
            $table->string('source')->nullable();          // 'payment', 'manual', 'promo'
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();      // null = lifetime
            $table->timestamp('revoked_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'course_id']);
            $table->index('user_id');
            $table->index('course_id');
            $table->index('revoked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_access_grants');
    }
};
