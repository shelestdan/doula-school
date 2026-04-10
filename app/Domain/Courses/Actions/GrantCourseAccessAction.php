<?php

namespace App\Domain\Courses\Actions;

use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Models\CourseAccessGrant;
use App\Models\User;

class GrantCourseAccessAction
{
    public function execute(
        User $user,
        Course $course,
        string $source = 'manual',
        ?string $grantedBy = null,
        string $grantedByType = 'admin',
        ?\DateTimeInterface $endsAt = null,
        ?string $notes = null
    ): CourseAccessGrant {
        // Revoke any existing active grants first to avoid duplicates
        CourseAccessGrant::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereNull('revoked_at')
            ->update(['revoked_at' => now()]);

        return CourseAccessGrant::create([
            'user_id'         => $user->id,
            'course_id'       => $course->id,
            'granted_by'      => $grantedBy,
            'granted_by_type' => $grantedByType,
            'source'          => $source,
            'starts_at'       => now(),
            'ends_at'         => $endsAt,
            'notes'           => $notes,
        ]);
    }
}
