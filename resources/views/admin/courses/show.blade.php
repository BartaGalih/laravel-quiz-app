@extends('admin.layouts.app')
@section('title', $course->title)
@section('page-title', $course->title)
@section('breadcrumb', 'Course detail')

@section('header-actions')
    <a href="{{ route('admin.courses.edit', $course) }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-colors
              bg-blue-600 hover:bg-blue-700 text-white">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Edit Course
    </a>
@endsection

@section('content')

<div class="grid lg:grid-cols-3 gap-4">

    {{-- Left --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Overview card --}}
        <div class="rounded-2xl border px-6 py-5 bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Overview</h2>
                <span @class([
                    'inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold',
                    'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400' => $course->is_published,
                    'bg-slate-100  text-slate-500  dark:bg-slate-800     dark:text-slate-400'    => !$course->is_published,
                ])>{{ $course->is_published ? 'Published' : 'Draft' }}</span>
            </div>
            @if($course->description)
                <p class="text-sm mb-4 text-slate-600 dark:text-slate-400">{{ $course->description }}</p>
            @endif
            <div class="flex gap-6 text-sm">
                <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $course->materials->count() }}</span> <span class="text-slate-400 dark:text-slate-500">Materials</span></div>
                <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $course->quizzes->count() }}</span>   <span class="text-slate-400 dark:text-slate-500">Quizzes</span></div>
                <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $course->enrollments->count() }}</span><span class="text-slate-400 dark:text-slate-500"> Enrolled</span></div>
            </div>
        </div>

        {{-- Materials --}}
        <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-50 dark:border-slate-800">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Materials</h2>
                <span class="text-xs text-slate-400 dark:text-slate-500">{{ $course->materials->count() }} item{{ $course->materials->count() !== 1 ? 's' : '' }}</span>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($course->materials as $material)
                    <div class="flex items-center gap-4 px-6 py-4">
                        <div @class([
                            'w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0',
                            'bg-red-50  dark:bg-red-900/20'  => $material->type === 'document',
                            'bg-blue-50 dark:bg-blue-900/20' => $material->type === 'video',
                        ])>
                            @if($material->type === 'document')
                                <svg class="w-4 h-4 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $material->title }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500">
                                @if($material->type === 'document') {{ $material->page_count }} pages
                                @else {{ $material->formatted_duration }}
                                @endif
                            </p>
                        </div>
                        <span class="text-xs font-medium uppercase tracking-wide text-slate-400 dark:text-slate-500">{{ $material->type }}</span>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-600">No materials yet.</div>
                @endforelse
            </div>
        </div>

        {{-- Quizzes --}}
        <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-50 dark:border-slate-800">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Quizzes</h2>
                <a href="{{ route('admin.quizzes.create') }}?course_id={{ $course->id }}"
                   class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                    + Add Quiz
                </a>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($course->quizzes as $quiz)
                    <div class="flex items-center gap-4 px-6 py-4 transition-colors group hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-green-50 dark:bg-green-900/20">
                            <svg class="w-4 h-4 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $quiz->title }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500">
                                {{ $quiz->questions->count() }} questions · {{ $quiz->duration_minutes }} min
                                @if($quiz->due_date) · Due {{ $quiz->due_date->format('D, d M, g:i A') }} @endif
                            </p>
                        </div>
                        <a href="{{ route('admin.quizzes.show', $quiz) }}"
                           class="p-1.5 rounded-lg transition-colors opacity-0 group-hover:opacity-100 text-slate-300 hover:text-blue-500 dark:text-slate-600 dark:hover:text-blue-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-600">No quizzes yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Right: Enrolled users --}}
    <div class="rounded-2xl border overflow-hidden h-fit bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
            <h2 class="font-bold text-slate-800 dark:text-slate-100">Enrolled Users</h2>
        </div>
        <div class="divide-y divide-slate-50 dark:divide-slate-800 max-h-96 overflow-y-auto">
            @forelse($course->enrollments as $enrollment)
                <div class="flex items-center gap-3 px-5 py-3.5">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 bg-blue-100 dark:bg-blue-900/40">
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">
                            {{ strtoupper(substr($enrollment->user->name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate text-slate-700 dark:text-slate-200">{{ $enrollment->user->name }}</p>
                        <p class="text-xs truncate text-slate-400 dark:text-slate-500">{{ $enrollment->user->email }}</p>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-600">No enrollments yet.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
