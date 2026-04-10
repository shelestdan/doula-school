<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Domain\Courses\Models\Course;
use App\Domain\News\Models\News;
use App\Domain\Services\Models\Service;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticUrls = [
            ['loc' => url('/'),               'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => url('/about'),          'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/doula'),          'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => url('/birth-prep'),     'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/partner-birth'),  'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/school'),         'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/services'),       'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/courses'),        'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => url('/news'),           'priority' => '0.7', 'changefreq' => 'daily'],
            ['loc' => url('/partners'),       'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => url('/faq'),            'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => url('/prices'),         'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => url('/contacts'),       'priority' => '0.6', 'changefreq' => 'yearly'],
            // City landing pages
            ['loc' => url('/doula-balashikha'),          'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/doula-moskva'),              'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/doula-zheleznodorozhny'),    'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => url('/doula-reutov'),              'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        $courses = Course::published()->get(['slug', 'updated_at']);
        $news    = News::published()->get(['slug', 'updated_at']);
        $services = Service::active()->get(['slug', 'updated_at']);

        $xml = view('sitemap', compact('staticUrls', 'courses', 'news', 'services'));

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
