<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuizController extends Controller
{
    public function index(Request $request): View
    {
        $query = Quiz::with('course')
                     ->withCount(['questions', 'attempts'])
                     ->latest();

        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $quizzes = $query->paginate(10)->withQueryString();

        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create(): View
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1|max:360',
            'passing_score'    => 'required|integer|min:0|max:100',
            'due_date'         => 'nullable|date',
            'is_published'     => 'sometimes|boolean',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $quiz = Quiz::create($data);

        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Quiz created. Now add questions.');
    }

    public function show(Quiz $quiz): View
    {
        $quiz->load(['course', 'questions.options', 'attempts.user']);
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz): View
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, Quiz $quiz): RedirectResponse
    {
        $data = $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1|max:360',
            'passing_score'    => 'required|integer|min:0|max:100',
            'due_date'         => 'nullable|date',
            'is_published'     => 'sometimes|boolean',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $quiz->update($data);

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz): RedirectResponse
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Quiz deleted successfully.');
    }
}
