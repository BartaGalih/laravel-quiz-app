@extends('admin.layouts.app')
@section('title', 'Create Quiz')
@section('page-title', 'Create Quiz')

@section('content')
@php
$inputClass = 'w-full px-4 py-2.5 text-sm rounded-xl transition
               bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400
               focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100
               dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:placeholder-slate-500
               dark:focus:border-blue-500 dark:focus:ring-blue-900/30';
$labelClass = 'block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300';
@endphp

<div class="max-w-2xl">
    <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
            <h2 class="font-bold text-slate-800 dark:text-slate-100">Quiz Information</h2>
        </div>
        <form method="POST" action="{{ route('admin.quizzes.store') }}" class="px-6 py-6 space-y-5">
            @csrf
            <div>
                <label class="{{ $labelClass }}">Course <span class="text-red-500">*</span></label>
                <select name="course_id" required class="{{ $inputClass }}">
                    <option value="">Select a course...</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ (old('course_id', request('course_id'))) == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
                @error('course_id') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="{{ $labelClass }}">Quiz Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="{{ $inputClass }}" placeholder="e.g. Quiz 1">
                @error('title') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="{{ $labelClass }}">Description</label>
                <textarea name="description" rows="3" class="{{ $inputClass }} resize-none"
                          placeholder="Optional description...">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="{{ $labelClass }}">Duration (minutes) <span class="text-red-500">*</span></label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 60) }}"
                           required min="1" max="360" class="{{ $inputClass }}">
                    @error('duration_minutes') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Passing Score (%) <span class="text-red-500">*</span></label>
                    <input type="number" name="passing_score" value="{{ old('passing_score', 70) }}"
                           required min="0" max="100" class="{{ $inputClass }}">
                    @error('passing_score') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="{{ $labelClass }}">Due Date</label>
                <input type="datetime-local" name="due_date" value="{{ old('due_date') }}" class="{{ $inputClass }}">
                @error('due_date') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center gap-3 pt-1">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" id="is_published"
                           class="sr-only peer" {{ old('is_published') ? 'checked' : '' }}>
                    <div class="w-10 h-6 rounded-full transition-colors
                                bg-slate-200 dark:bg-slate-700 peer-checked:bg-blue-600
                                peer-checked:after:translate-x-4
                                after:content-[''] after:absolute after:top-0.5 after:left-0.5
                                after:bg-white after:rounded-full after:w-5 after:h-5 after:transition-transform">
                    </div>
                </label>
                <label for="is_published" class="text-sm font-medium cursor-pointer text-slate-700 dark:text-slate-300">
                    Publish this quiz
                </label>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm
                               bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200 dark:shadow-blue-900/30">
                    Create Quiz
                </button>
                <a href="{{ route('admin.quizzes.index') }}"
                   class="px-6 py-2.5 text-sm font-medium transition-colors text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
