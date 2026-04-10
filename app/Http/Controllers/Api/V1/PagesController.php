<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\Pages\Models\Page;
use Illuminate\Http\JsonResponse;

class PagesController extends Controller
{
    public function show(string $slug): JsonResponse
    {
        $page = Page::where('slug', $slug)->where('status', 'published')
            ->with('publishedBlocks')
            ->firstOrFail();

        return response()->json($page);
    }
}
