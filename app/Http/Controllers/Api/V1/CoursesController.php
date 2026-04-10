<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\Courses\Models\Course;
use Illuminate\Http\JsonResponse;

class CoursesController extends Controller
{
    public function index(): JsonResponse
    {
        $courses = Course::published()
            ->select(['id', 'title', 'slug', 'short_desc', 'price', 'old_price', 'cover', 'badge', 'is_featured'])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return response()->json($courses);
    }

    public function show(string $slug): JsonResponse
    {
        $course = Course::published()
            ->where('slug', $slug)
            ->with(['modules.publishedLessons:id,module_id,title,video_duration,is_preview,sort_order'])
            ->firstOrFail();

        return response()->json($course);
    }
}
