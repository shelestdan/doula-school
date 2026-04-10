<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Courses\Models\Course;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::published()
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function show(string $slug): View
    {
        $course = Course::published()
            ->where('slug', $slug)
            ->with(['modules.publishedLessons'])
            ->firstOrFail();

        $hasAccess = auth()->check()
            ? auth()->user()->hasAccessToCourse($course->id)
            : false;

        return view('courses.show', compact('course', 'hasAccess'));
    }
}
