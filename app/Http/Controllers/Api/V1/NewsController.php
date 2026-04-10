<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\News\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $posts = News::published()
            ->select(['id', 'title', 'slug', 'excerpt', 'cover', 'publish_at', 'category'])
            ->orderByDesc('publish_at')
            ->paginate($request->integer('per_page', 12));

        return response()->json($posts);
    }

    public function show(string $slug): JsonResponse
    {
        $post = News::published()->where('slug', $slug)->firstOrFail();
        return response()->json($post);
    }
}
