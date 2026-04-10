<?php

namespace App\Domain\Courses\Actions;

use App\Domain\Courses\Models\Lesson;
use App\Domain\Courses\Models\LessonProgress;
use App\Models\User;

class MarkLessonCompletedAction
{
    public function execute(User $user, Lesson $lesson): LessonProgress
    {
        return LessonProgress::updateOrCreate(
            [
                'user_id'   => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'course_id'    => $lesson->course_id,
                'completed_at' => now(),
            ]
        );
    }
}
