<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Pages\Models\Page;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('page', compact('page'));
    }

    public function privacy(): View
    {
        $page = Page::where('slug', 'privacy')->where('status', 'published')->first();
        return view('privacy', compact('page'));
    }

    public function terms(): View
    {
        $page = Page::where('slug', 'terms')->where('status', 'published')->first();
        return view('terms', compact('page'));
    }
}
