<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Models\Lesson;
use App\Domain\Courses\Actions\MarkLessonCompletedAction;

class CoursePlayerController extends Controller
{
    public function show(Course $course): View
    {
        $course->load(['modules.publishedLessons']);

        $progress = auth()->user()->lessonProgress()
            ->where('course_id', $course->id)
            ->pluck('completed_at', 'lesson_id');

        $firstLesson = $course->modules->first()?->publishedLessons->first();

        return view('account.course-player', compact('course', 'progress', 'firstLesson'));
    }

    public function lesson(Course $course, Lesson $lesson): View
    {
        abort_unless($lesson->course_id === $course->id, 404);
        $course->load(['modules.publishedLessons']);

        $progress = auth()->user()->lessonProgress()
            ->where('course_id', $course->id)
            ->pluck('completed_at', 'lesson_id');

        return view('account.lesson', compact('course', 'lesson', 'progress'));
    }

    public function complete(
        Course $course,
        Lesson $lesson,
        MarkLessonCompletedAction $action
    ): JsonResponse {
        abort_unless($lesson->course_id === $course->id, 404);

        $action->execute(auth()->user(), $lesson);

        return response()->json(['status' => 'ok']);
    }
}
