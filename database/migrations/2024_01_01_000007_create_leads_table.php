<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->text('message')->nullable();

            // Lead source
            $table->string('source')->nullable();       // form_name, e.g. "consultation", "lead_magnet"
            $table->string('page_url')->nullable();
            $table->string('referer')->nullable();

            // UTM
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('utm_term')->nullable();

            // CRM
            $table->string('status')->default('new');   // new, in_progress, contacted, booked, paid, closed, canceled
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->json('tags')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
            $table->index('utm_source');
            $table->index('source');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
