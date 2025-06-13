<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\LearnerProgressService;
use Illuminate\Http\Request;

class LearnerProgressController extends Controller
{
    public function __construct(private LearnerProgressService $learnerProgressService) {}

    public function index(Request $request)
    {
        $courseId = $request->input('course_id');
        $sort = $request->input('sort');

        $learners = $this->learnerProgressService->getLearnersWithProgress($courseId, $sort);
        $courses = Course::all();

        return view('learnerProgress.index', compact('learners', 'courses', 'courseId', 'sort'));
    }
}
