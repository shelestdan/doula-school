<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Courses\Models\Course;
use App\Domain\Services\Models\Service;
use App\Domain\Partners\Models\Partner;
use App\Domain\News\Models\News;
use App\Domain\Settings\Services\SettingsService;

class HomeController extends Controller
{
    public function index(SettingsService $settingsService): View
    {
        $settings = $settingsService->all();

        $services = Service::active()->limit(6)->get();

        $courses = Course::published()
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $partners = Partner::active()->limit(8)->get();

        $latestNews = News::published()
            ->orderByDesc('publish_at')
            ->limit(3)
            ->get();

        $specialist = [
            'name' => $settings['specialist_name'] ?? 'Елена Тимофеева',
            'title' => $settings['specialist_title'] ?? 'Доула · Консультант по материнству',
            'headline' => 'Подготовка к родам без страха и лишнего шума',
            'subline' => 'Сопровождение, консультации, онлайн-курсы и офлайн-школа материнства в Балашихе.',
            'bio' => '<p>Я помогаю женщинам спокойно подготовиться к родам, понимать свои варианты и чувствовать опору рядом. В работе соединяю практику доулы, консультации по материнству и очные занятия школы материнства в Балашихе.</p>',
            'photo' => $this->sitePhoto($settings, 'specialist_photo', 'images/site/doula-hero.jpg'),
            'about_photo' => $this->sitePhoto($settings, 'specialist_about_photo', 'images/site/doula-work.jpg'),
            'certificate_photo' => $this->sitePhoto($settings, 'specialist_certificate_photo', 'images/site/doula-certificate.jpg'),
        ];

        $heroStats = [
            ['value' => '1:1', 'label' => 'индивидуальная подготовка'],
            ['value' => 'онлайн', 'label' => 'курсы и консультации'],
            ['value' => 'роддом', 'label' => 'сопровождение в родах'],
        ];

        $certifications = [
            'Профессиональная доула',
            'Консультант по материнству и детскому здоровью',
            'Подготовка к партнёрским родам',
        ];

        $credentials = [
            ['icon' => '1:1', 'value' => '1:1', 'label' => 'личный формат работы'],
            ['icon' => 'К', 'value' => 'онлайн', 'label' => 'подготовка в удобном темпе'],
        ];

        $values = [
            ['title' => 'Без давления', 'desc' => 'Поддержка выбора семьи, а не чужой сценарий'],
            ['title' => 'Практично', 'desc' => 'Дыхание, позы, план родов, контакт с персоналом'],
            ['title' => 'Спокойно', 'desc' => 'Понятные шаги вместо тревожной теории'],
            ['title' => 'Честно', 'desc' => 'Только то, что можно применить в реальной ситуации'],
        ];

        return view('home', compact(
            'services',
            'courses',
            'partners',
            'latestNews',
            'specialist',
            'heroStats',
            'certifications',
            'credentials',
            'values',
        ));
    }

    private function sitePhoto(array $settings, string $settingKey, string $fallbackPath): ?string
    {
        $configuredPath = trim((string) ($settings[$settingKey] ?? ''));

        if ($configuredPath !== '') {
            return $configuredPath;
        }

        return file_exists(public_path($fallbackPath)) ? asset($fallbackPath) : null;
    }
}
