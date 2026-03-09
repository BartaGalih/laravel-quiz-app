<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'         => User::where('is_admin', false)->count(),
            'new_users_this_month'=> User::where('is_admin', false)
                                         ->whereMonth('created_at', now()->month)
                                         ->whereYear('created_at', now()->year)
                                         ->count(),
            'total_courses'       => Course::count(),
            'published_courses'   => Course::where('is_published', true)->count(),
            'total_quizzes'       => Quiz::count(),
            'total_questions'     => Question::count(),
            'attempts_today'      => QuizAttempt::whereDate('started_at', today())->count(),
            'pass_rate'           => $this->calcPassRate(),
        ];

        $recentCourses  = Course::with(['materials', 'quizzes'])
                                ->latest()
                                ->take(5)
                                ->get();

        $recentAttempts = QuizAttempt::with(['user', 'quiz'])
                                     ->latest('started_at')
                                     ->take(8)
                                     ->get();

        return view('admin.dashboard.index', compact('stats', 'recentCourses', 'recentAttempts'));
    }

    private function calcPassRate(): int
    {
        $total  = QuizAttempt::whereNotNull('is_passed')->count();
        if ($total === 0) return 0;
        $passed = QuizAttempt::where('is_passed', true)->count();
        return (int) round(($passed / $total) * 100);
    }
}
