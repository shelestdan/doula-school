<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Domain\Courses\Models\Course;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');

        if (! $course instanceof Course) {
            $slug   = $request->route('course');
            $course = Course::where('slug', $slug)->firstOrFail();
        }

        if (! auth()->user()->hasAccessToCourse($course->id)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Нет доступа к курсу.'], 403);
            }

            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Для просмотра курса необходимо его приобрести.');
        }

        return $next($request);
    }
}
