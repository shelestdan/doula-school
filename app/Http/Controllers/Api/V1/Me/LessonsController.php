<?php

namespace App\Http\Controllers\Api\V1\Me;

use App\Http\Controllers\Controller;
use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Models\Lesson;
use App\Domain\Courses\Actions\MarkLessonCompletedAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function show(Request $request, string $slug, Lesson $lesson): JsonResponse
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        abort_unless($request->user()->hasAccessToCourse($course->id), 403);
        abort_unless($lesson->course_id === $course->id, 404);

        return response()->json($lesson);
    }

    public function complete(
        Request $request,
        string $slug,
        Lesson $lesson,
        MarkLessonCompletedAction $action
    ): JsonResponse {
        $course = Course::where('slug', $slug)->firstOrFail();
        abort_unless($request->user()->hasAccessToCourse($course->id), 403);
        abort_unless($lesson->course_id === $course->id, 404);

        $action->execute($request->user(), $lesson);

        return response()->json(['status' => 'ok']);
    }
}
