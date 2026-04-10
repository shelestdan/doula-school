<?php

namespace App\Domain\Courses\Actions;

use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Models\CourseAccessGrant;
use App\Models\User;

class RevokeCourseAccessAction
{
    public function execute(User $user, Course $course): void
    {
        CourseAccessGrant::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereNull('revoked_at')
            ->update(['revoked_at' => now()]);
    }
}
