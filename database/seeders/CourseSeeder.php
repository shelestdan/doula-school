<?php

namespace Database\Seeders;

use App\Domain\Courses\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Сила родов',
                'slug' => 'sila-rodov',
                'short_desc' => 'База подготовки к родам: тело, дыхание, этапы родов, решения в роддоме.',
                'description' => '<p>Курс помогает понять, что происходит в родах, как поддерживать себя на каждом этапе и какие решения обсудить с врачом заранее.</p>',
                'price' => 3900,
                'old_price' => null,
                'level' => 'beginner',
                'duration_hours' => 6,
                'lessons_count' => 8,
                'badge' => 'Хит',
                'is_featured' => true,
                'sort_order' => 10,
                'what_you_learn' => [
                    'Этапы родов и нормальные варианты течения',
                    'Дыхание, позы и способы самопомощи',
                    'Что взять в роддом и как составить план родов',
                ],
                'meta_title' => 'Курс «Сила родов» — подготовка к родам',
                'meta_description' => 'Онлайн-курс по подготовке к родам: этапы, дыхание, план родов, поддержка в роддоме.',
            ],
            [
                'title' => 'Партнёрские роды',
                'slug' => 'partnerskie-rody',
                'short_desc' => 'Курс для пары: как партнёру помогать в родах спокойно, точно и без растерянности.',
                'description' => '<p>Курс показывает партнёру конкретные действия: что говорить, как помогать телу, когда звать персонал и как не мешать процессу.</p>',
                'price' => 2500,
                'old_price' => null,
                'level' => 'beginner',
                'duration_hours' => 4,
                'lessons_count' => 5,
                'badge' => null,
                'is_featured' => false,
                'sort_order' => 20,
                'what_you_learn' => [
                    'Роль партнёра на каждом этапе родов',
                    'Поддерживающие фразы и действия',
                    'Массаж, позы, вода, контакт с персоналом',
                ],
                'meta_title' => 'Курс «Партнёрские роды»',
                'meta_description' => 'Онлайн-курс для пары: подготовка партнёра к поддержке женщины в родах.',
            ],
            [
                'title' => 'Первые месяцы с малышом',
                'slug' => 'pervye-mesyatsy-s-malyshom',
                'short_desc' => 'Первые недели после родов: восстановление, уход, грудное вскармливание, спокойный быт.',
                'description' => '<p>Курс помогает подготовиться к первым неделям дома: уход за малышом, восстановление мамы, организация помощи и базовые сигналы, когда нужен специалист.</p>',
                'price' => 2900,
                'old_price' => null,
                'level' => 'beginner',
                'duration_hours' => 5,
                'lessons_count' => 6,
                'badge' => 'Новинка',
                'is_featured' => false,
                'sort_order' => 30,
                'what_you_learn' => [
                    'Уход за новорождённым без лишней тревоги',
                    'Восстановление мамы после родов',
                    'Как организовать помощь дома',
                ],
                'meta_title' => 'Курс «Первые месяцы с малышом»',
                'meta_description' => 'Онлайн-курс о первых неделях после родов: уход, восстановление, быт, помощь.',
            ],
        ];

        foreach ($courses as $course) {
            Course::firstOrCreate(
                ['slug' => $course['slug']],
                $course + [
                    'currency' => 'RUB',
                    'access_type' => 'lifetime',
                    'is_active' => true,
                    'is_published' => true,
                    'status' => 'published',
                    'published_at' => now(),
                ],
            );
        }
    }
}
