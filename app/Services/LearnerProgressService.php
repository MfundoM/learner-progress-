<?php

namespace App\Services;

use App\Models\Learner;

class LearnerProgressService
{
    public function getLearnersWithProgress(?int $courseId = null, ?string $sort = 'asc')
    {
        $query = Learner::with('enrolments.course')
            ->withAverageProgress()
            ->filterByCourse($courseId);

        if (in_array($sort, ['asc', 'desc'])) {
            $query->orderBy('avg_progress', $sort);
        }

        return $query->paginate(10)->withQueryString();
    }
}
