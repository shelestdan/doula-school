<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('module_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->string('video_url')->nullable();       // external video URL
            $table->integer('duration')->nullable();       // minutes
            $table->boolean('is_preview')->default(false); // accessible without purchase
            $table->boolean('is_published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['course_id', 'slug']);
            $table->index(['course_id', 'sort_order']);
            $table->index(['module_id', 'sort_order']);
            $table->index('is_published');
            $table->index('is_preview');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
