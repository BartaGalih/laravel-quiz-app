@extends('admin.layouts.app')
@section('title', $user->name)
@section('page-title', $user->name)
@section('breadcrumb', 'User profile')

@section('content')
<div class="grid lg:grid-cols-3 gap-4">

    {{-- Profile card --}}
    <div class="rounded-2xl border px-6 py-6 text-center h-fit
                bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 bg-blue-100 dark:bg-blue-900/40">
            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
        </div>
        <h2 class="font-bold text-lg text-slate-800 dark:text-slate-100">{{ $user->name }}</h2>
        <p class="text-sm mt-0.5 text-slate-400 dark:text-slate-500">{{ $user->email }}</p>
        <p class="text-xs mt-3 text-slate-400 dark:text-slate-500">Joined {{ $user->created_at->format('d M Y') }}</p>
        <div class="flex justify-center gap-6 mt-5 pt-5 border-t border-slate-100 dark:border-slate-800">
            <div>
                <p class="font-bold text-slate-800 dark:text-slate-100">{{ $user->enrollments->count() }}</p>
                <p class="text-xs text-slate-400 dark:text-slate-500">Enrolled</p>
            </div>
            <div>
                <p class="font-bold text-slate-800 dark:text-slate-100">{{ $user->quizAttempts->count() }}</p>
                <p class="text-xs text-slate-400 dark:text-slate-500">Attempts</p>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-4">

        {{-- Enrolled courses --}}
        <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Enrolled Courses</h2>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($user->enrollments as $enrollment)
                    <div class="flex items-center justify-between px-6 py-4">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $enrollment->course->title }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500">{{ $enrollment->enrolled_at->format('d M Y') }}</p>
                    </div>
                @empty
                    <div class="px-6 py-6 text-center text-sm text-slate-400 dark:text-slate-600">Not enrolled in any courses.</div>
                @endforelse
            </div>
        </div>

        {{-- Quiz attempts --}}
        <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Quiz Attempts</h2>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($user->quizAttempts as $attempt)
                    <div class="flex items-center justify-between px-6 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $attempt->quiz->title }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500">
                                {{ $attempt->quiz->course->title }} · {{ $attempt->started_at->format('d M Y') }}
                            </p>
                        </div>
                        @if($attempt->score !== null)
                            <span class="font-bold text-sm {{ $attempt->is_passed ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                                {{ $attempt->score }}%
                            </span>
                        @else
                            <span class="text-xs font-semibold text-amber-500 dark:text-amber-400">In progress</span>
                        @endif
                    </div>
                @empty
                    <div class="px-6 py-6 text-center text-sm text-slate-400 dark:text-slate-600">No quiz attempts yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
