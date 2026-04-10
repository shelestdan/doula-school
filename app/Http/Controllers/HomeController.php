<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Courses\Models\Course;
use App\Domain\Services\Models\Service;
use App\Domain\Partners\Models\Partner;
use App\Domain\News\Models\News;

class HomeController extends Controller
{
    public function index(): View
    {
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

        return view('home', compact('services', 'courses', 'partners', 'latestNews'));
    }
}
