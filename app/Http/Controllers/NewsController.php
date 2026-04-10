<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\News\Models\News;

class NewsController extends Controller
{
    public function index(): View
    {
        $posts = News::published()
            ->orderByDesc('publish_at')
            ->paginate(12);

        return view('news.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = News::published()->where('slug', $slug)->firstOrFail();
        $post->increment('views');

        $related = News::published()
            ->where('id', '!=', $post->id)
            ->orderByDesc('publish_at')
            ->limit(3)
            ->get();

        return view('news.show', compact('post', 'related'));
    }
}
