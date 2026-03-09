<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Course::withCount(['materials', 'quizzes', 'enrollments'])
                       ->latest();

        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->get('status') === 'published') {
            $query->where('is_published', true);
        } elseif ($request->get('status') === 'draft') {
            $query->where('is_published', false);
        }

        $courses = $query->paginate(10)->withQueryString();

        return view('admin.courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'icon_type'    => 'required|string|in:code,design,math,science,language,other',
            'is_published' => 'sometimes|boolean',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        Course::create($data);

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Course created successfully.');
    }

    public function show(Course $course): View
    {
        $course->load(['materials', 'quizzes.questions', 'enrollments.user']);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        $course->load(['materials', 'quizzes']);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'icon_type'    => 'required|string|in:code,design,math,science,language,other',
            'is_published' => 'sometimes|boolean',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $course->update($data);

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Course deleted successfully.');
    }

    public function togglePublish(Course $course): RedirectResponse
    {
        $course->update(['is_published' => !$course->is_published]);

        $status = $course->is_published ? 'published' : 'unpublished';
        return back()->with('success', "Course {$status} successfully.");
    }
}
