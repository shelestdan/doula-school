<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (! Schema::hasColumn('courses', 'short_desc')) {
                $table->text('short_desc')->nullable();
            }

            if (! Schema::hasColumn('courses', 'description')) {
                $table->longText('description')->nullable();
            }

            if (! Schema::hasColumn('courses', 'video_preview_url')) {
                $table->string('video_preview_url')->nullable();
            }

            if (! Schema::hasColumn('courses', 'currency')) {
                $table->string('currency', 3)->default('RUB');
            }

            if (! Schema::hasColumn('courses', 'access_days')) {
                $table->unsignedInteger('access_days')->nullable();
            }

            if (! Schema::hasColumn('courses', 'level')) {
                $table->string('level')->nullable();
            }

            if (! Schema::hasColumn('courses', 'duration_hours')) {
                $table->unsignedInteger('duration_hours')->nullable();
            }

            if (! Schema::hasColumn('courses', 'lessons_count')) {
                $table->unsignedInteger('lessons_count')->nullable();
            }

            if (! Schema::hasColumn('courses', 'what_you_learn')) {
                $table->json('what_you_learn')->nullable();
            }

            if (! Schema::hasColumn('courses', 'requirements')) {
                $table->json('requirements')->nullable();
            }

            if (! Schema::hasColumn('courses', 'includes')) {
                $table->json('includes')->nullable();
            }

            if (! Schema::hasColumn('courses', 'is_published')) {
                $table->boolean('is_published')->default(false)->index();
            }

            if (! Schema::hasColumn('courses', 'badge')) {
                $table->string('badge')->nullable();
            }

            if (! Schema::hasColumn('courses', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable();
            }

            if (! Schema::hasColumn('courses', 'og_title')) {
                $table->string('og_title')->nullable();
            }

            if (! Schema::hasColumn('courses', 'og_description')) {
                $table->text('og_description')->nullable();
            }
        });

        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'short_desc')) {
                $table->text('short_desc')->nullable();
            }

            if (! Schema::hasColumn('services', 'price_from')) {
                $table->boolean('price_from')->default(false);
            }

            if (! Schema::hasColumn('services', 'price_note')) {
                $table->string('price_note')->nullable();
            }

            if (! Schema::hasColumn('services', 'is_active')) {
                $table->boolean('is_active')->default(true)->index();
            }

            if (! Schema::hasColumn('services', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });

        Schema::table('partners', function (Blueprint $table) {
            if (! Schema::hasColumn('partners', 'is_active')) {
                $table->boolean('is_active')->default(true)->index();
            }
        });

        $this->copyLegacyCatalogData();
    }

    public function down(): void
    {
        $this->dropColumns('partners', ['is_active']);

        $this->dropColumns('services', [
            'short_desc',
            'price_from',
            'price_note',
            'is_active',
            'is_featured',
        ]);

        $this->dropColumns('courses', [
            'short_desc',
            'description',
            'video_preview_url',
            'currency',
            'access_days',
            'level',
            'duration_hours',
            'lessons_count',
            'what_you_learn',
            'requirements',
            'includes',
            'is_published',
            'badge',
            'meta_keywords',
            'og_title',
            'og_description',
        ]);
    }

    private function copyLegacyCatalogData(): void
    {
        if (Schema::hasColumn('courses', 'short_description') && Schema::hasColumn('courses', 'short_desc')) {
            DB::table('courses')
                ->whereNull('short_desc')
                ->update(['short_desc' => DB::raw('short_description')]);
        }

        if (Schema::hasColumn('courses', 'full_description') && Schema::hasColumn('courses', 'description')) {
            DB::table('courses')
                ->whereNull('description')
                ->update(['description' => DB::raw('full_description')]);
        }

        if (Schema::hasColumn('courses', 'status') && Schema::hasColumn('courses', 'is_published')) {
            DB::table('courses')
                ->where('status', 'published')
                ->update(['is_published' => true]);
        }

        if (Schema::hasColumn('services', 'short_description') && Schema::hasColumn('services', 'short_desc')) {
            DB::table('services')
                ->whereNull('short_desc')
                ->update(['short_desc' => DB::raw('short_description')]);
        }

        if (Schema::hasColumn('services', 'status') && Schema::hasColumn('services', 'is_active')) {
            DB::table('services')
                ->where('status', '!=', 'published')
                ->update(['is_active' => false]);
        }

        if (Schema::hasColumn('partners', 'status') && Schema::hasColumn('partners', 'is_active')) {
            DB::table('partners')
                ->where('status', '!=', 'published')
                ->update(['is_active' => false]);
        }
    }

    private function dropColumns(string $tableName, array $columns): void
    {
        $existingColumns = array_values(array_filter(
            $columns,
            fn (string $column): bool => Schema::hasColumn($tableName, $column),
        ));

        if ($existingColumns === []) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($existingColumns) {
            $table->dropColumn($existingColumns);
        });
    }
};
