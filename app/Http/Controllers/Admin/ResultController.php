<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function index(Request $request): View
    {
        $query = QuizAttempt::with(['user', 'quiz.course'])
                            ->latest('started_at');

        if ($search = $request->get('search')) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('quiz', fn($q) => $q->where('title', 'like', "%{$search}%"));
        }

        if ($status = $request->get('status')) {
            if ($status === 'passed')      $query->where('is_passed', true);
            if ($status === 'failed')      $query->where('is_passed', false);
            if ($status === 'in_progress') $query->whereNull('submitted_at');
        }

        $attempts = $query->paginate(15)->withQueryString();

        return view('admin.results.index', compact('attempts'));
    }

    public function show(QuizAttempt $attempt): View
    {
        $attempt->load(['user', 'quiz.course', 'answers.question.options', 'answers.option']);
        return view('admin.results.show', compact('attempt'));
    }
}
