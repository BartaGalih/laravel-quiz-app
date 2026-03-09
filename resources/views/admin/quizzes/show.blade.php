@extends('admin.layouts.app')
@section('title', $quiz->title)
@section('page-title', $quiz->title)
@section('breadcrumb', 'Quiz detail')

@section('header-actions')
    <a href="{{ route('admin.quizzes.edit', $quiz) }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-colors
              bg-blue-600 hover:bg-blue-700 text-white">
        Edit Quiz
    </a>
@endsection

@section('content')
<div class="grid lg:grid-cols-3 gap-4">

    <div class="lg:col-span-2 space-y-4">

        {{-- Overview --}}
        <div class="rounded-2xl border px-6 py-5 bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex gap-6 text-sm flex-wrap">
                <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $quiz->questions->count() }}</span> <span class="text-slate-400 dark:text-slate-500">Questions</span></div>
                <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $quiz->duration_minutes }} min</span> <span class="text-slate-400 dark:text-slate-500">Duration</span></div>
                <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $quiz->passing_score }}%</span> <span class="text-slate-400 dark:text-slate-500">Pass Score</span></div>
                @if($quiz->due_date)
                    <div><span class="font-bold text-slate-800 dark:text-slate-100">{{ $quiz->due_date->format('d M Y') }}</span> <span class="text-slate-400 dark:text-slate-500">Due Date</span></div>
                @endif
            </div>
        </div>

        {{-- Questions --}}
        <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Questions ({{ $quiz->questions->count() }})</h2>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($quiz->questions as $i => $question)
                    <div class="px-6 py-4">
                        <p class="text-sm font-semibold mb-3 text-slate-700 dark:text-slate-200">{{ $i + 1 }}. {{ $question->body }}</p>
                        <div class="space-y-1.5 ml-4">
                            @foreach($question->options as $option)
                                <div class="flex items-center gap-2.5">
                                    <div @class([
                                        'w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0',
                                        'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' => $option->is_correct,
                                        'border-slate-200 dark:border-slate-700'                   => !$option->is_correct,
                                    ])>
                                        @if($option->is_correct)
                                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                                        @endif
                                    </div>
                                    <span @class([
                                        'text-sm',
                                        'text-emerald-700 font-medium dark:text-emerald-400' => $option->is_correct,
                                        'text-slate-600 dark:text-slate-400'                 => !$option->is_correct,
                                    ])>{{ $option->body }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-600">No questions added yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Attempts --}}
    <div class="rounded-2xl border overflow-hidden h-fit bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
            <h2 class="font-bold text-slate-800 dark:text-slate-100">Recent Attempts</h2>
        </div>
        <div class="divide-y divide-slate-50 dark:divide-slate-800 max-h-96 overflow-y-auto">
            @forelse($quiz->attempts->take(20) as $attempt)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div>
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $attempt->user->name }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500">{{ $attempt->started_at->diffForHumans() }}</p>
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
                <div class="px-6 py-8 text-center text-sm text-slate-400 dark:text-slate-600">No attempts yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
