<?php

namespace App\Http\Controllers\Api\V1\Me;

use App\Http\Controllers\Controller;
use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Models\CourseAccessGrant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $grants = CourseAccessGrant::with('course')
            ->where('user_id', $request->user()->id)
            ->active()
            ->get();

        return response()->json($grants->pluck('course'));
    }

    public function show(Request $request, string $slug): JsonResponse
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        abort_unless($request->user()->hasAccessToCourse($course->id), 403, 'Нет доступа к курсу.');

        $course->load(['modules.publishedLessons']);

        $progress = $request->user()->lessonProgress()
            ->where('course_id', $course->id)
            ->get(['lesson_id', 'completed_at'])
            ->keyBy('lesson_id');

        return response()->json(compact('course', 'progress'));
    }
}
