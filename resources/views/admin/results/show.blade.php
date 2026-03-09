@extends('admin.layouts.app')
@section('title', 'Attempt Detail')
@section('page-title', 'Attempt Detail')
@section('breadcrumb', $attempt->user->name . ' — ' . $attempt->quiz->title)

@section('content')
<div class="grid lg:grid-cols-3 gap-4">

    {{-- Summary card --}}
    <div class="rounded-2xl border px-6 py-6 h-fit space-y-4
                bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div>
            <p class="text-xs uppercase tracking-wide font-semibold mb-1 text-slate-400 dark:text-slate-500">Student</p>
            <p class="font-bold text-slate-800 dark:text-slate-100">{{ $attempt->user->name }}</p>
            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $attempt->user->email }}</p>
        </div>
        <div>
            <p class="text-xs uppercase tracking-wide font-semibold mb-1 text-slate-400 dark:text-slate-500">Quiz</p>
            <p class="font-semibold text-slate-700 dark:text-slate-200">{{ $attempt->quiz->title }}</p>
            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $attempt->quiz->course->title }}</p>
        </div>
        <div class="grid grid-cols-2 gap-3 pt-2">
            <div class="rounded-xl px-4 py-3 text-center bg-slate-50 dark:bg-slate-800">
                <p class="text-2xl font-extrabold {{ $attempt->is_passed ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                    {{ $attempt->score ?? '—' }}{{ $attempt->score !== null ? '%' : '' }}
                </p>
                <p class="text-xs mt-0.5 text-slate-400 dark:text-slate-500">Score</p>
            </div>
            <div class="rounded-xl px-4 py-3 text-center bg-slate-50 dark:bg-slate-800">
                <p class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">
                    {{ $attempt->correct_answers ?? '—' }}/{{ $attempt->total_questions ?? '—' }}
                </p>
                <p class="text-xs mt-0.5 text-slate-400 dark:text-slate-500">Correct</p>
            </div>
        </div>
        <div>
            @if($attempt->submitted_at === null)
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold
                             bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    In Progress
                </span>
            @elseif($attempt->is_passed)
                <span class="inline-flex px-3 py-1.5 rounded-lg text-xs font-semibold
                             bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400">
                    ✓ Passed
                </span>
            @else
                <span class="inline-flex px-3 py-1.5 rounded-lg text-xs font-semibold
                             bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-400">
                    ✗ Failed
                </span>
            @endif
        </div>
        <div class="text-xs space-y-1 pt-2 border-t text-slate-400 dark:text-slate-500 border-slate-100 dark:border-slate-800">
            <p>Started: {{ $attempt->started_at->format('d M Y, H:i') }}</p>
            @if($attempt->submitted_at)
                <p>Submitted: {{ $attempt->submitted_at->format('d M Y, H:i') }}</p>
            @endif
        </div>
    </div>

    {{-- Answers --}}
    <div class="lg:col-span-2 rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
            <h2 class="font-bold text-slate-800 dark:text-slate-100">Answer Review</h2>
        </div>
        <div class="divide-y divide-slate-50 dark:divide-slate-800 max-h-[70vh] overflow-y-auto">
            @forelse($attempt->answers as $i => $answer)
                @php $correct = $answer->question->correctOption(); @endphp
                <div class="px-6 py-4">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $i + 1 }}. {{ $answer->question->body }}</p>
                        @if($answer->option?->is_correct)
                            <span class="flex-shrink-0 text-xs font-bold px-2.5 py-1 rounded-lg
                                         bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400">
                                ✓ Correct
                            </span>
                        @elseif($answer->question_option_id)
                            <span class="flex-shrink-0 text-xs font-bold px-2.5 py-1 rounded-lg
                                         bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400">
                                ✗ Wrong
                            </span>
                        @else
                            <span class="flex-shrink-0 text-xs font-bold px-2.5 py-1 rounded-lg
                                         bg-slate-50 text-slate-400 dark:bg-slate-800 dark:text-slate-500">
                                — Skipped
                            </span>
                        @endif
                    </div>
                    @if($answer->option)
                        <div class="ml-3 space-y-1 text-xs">
                            <p class="text-slate-500 dark:text-slate-400">
                                Answered:
                                <span class="font-medium text-slate-700 dark:text-slate-200">{{ $answer->option->body }}</span>
                            </p>
                            @if(!$answer->option->is_correct && $correct)
                                <p class="text-slate-500 dark:text-slate-400">
                                    Correct:
                                    <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $correct->body }}</span>
                                </p>
                            @endif
                        </div>
                    @endif
                    @if($answer->is_flagged)
                        <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-red-500 dark:text-red-400">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a1 1 0 000 2h2.586l-3.293 3.293a1 1 0 101.414 1.414L9 6.414V9a1 1 0 102 0V6.414l3.293 3.293a1 1 0 001.414-1.414L12.414 5H15a1 1 0 000-2H5z"/>
                            </svg>
                            Flagged
                        </span>
                    @endif
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-600">No answers recorded.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
