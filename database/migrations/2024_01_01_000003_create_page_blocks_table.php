<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // hero, text, features, cta, services, courses, faq, partners, testimonials, pricing, contacts
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->json('buttons')->nullable();    // [{label, url, style}]
            $table->json('config')->nullable();      // block-specific data
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['page_id', 'sort_order']);
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_blocks');
    }
};
