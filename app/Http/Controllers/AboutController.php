<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Services\Models\Service;
use App\Domain\Courses\Models\Course;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('about');
    }

    public function doula(): View
    {
        $service = Service::where('slug', 'doula-v-rodah')->first();
        return view('doula', compact('service'));
    }

    public function birthPrep(): View
    {
        $course = Course::published()->where('slug', 'podgotovka-k-rodam')->first();
        return view('birth-prep', compact('course'));
    }

    public function partnerBirth(): View
    {
        return view('partner-birth');
    }

    public function school(): View
    {
        return view('school');
    }

    public function prices(): View
    {
        $services = Service::active()->get();
        $courses  = Course::published()->orderBy('sort_order')->get();
        return view('prices', compact('services', 'courses'));
    }
}
