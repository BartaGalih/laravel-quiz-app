@extends('admin.layouts.app')
@section('title', 'Results')
@section('page-title', 'Quiz Results')
@section('breadcrumb', 'All quiz attempt records')

@section('content')

@php
$inputClass = 'text-sm rounded-xl transition focus:outline-none
               bg-slate-50 border border-slate-200 text-slate-700 placeholder-slate-400
               focus:border-blue-400 focus:ring-2 focus:ring-blue-100
               dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:placeholder-slate-500
               dark:focus:border-blue-500 dark:focus:ring-blue-900/30';
@endphp

<div class="rounded-2xl border mb-4 px-5 py-4 flex flex-wrap items-center gap-3
            bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <form method="GET" class="flex-1 flex items-center gap-3 min-w-0">
        <div class="relative flex-1 max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 dark:text-slate-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user or quiz..."
                   class="{{ $inputClass }} w-full pl-9 pr-4 py-2.5">
        </div>
        <select name="status" onchange="this.form.submit()" class="{{ $inputClass }} px-3 py-2.5">
            <option value="">All Results</option>
            <option value="passed"      {{ request('status') === 'passed'      ? 'selected' : '' }}>Passed</option>
            <option value="failed"      {{ request('status') === 'failed'      ? 'selected' : '' }}>Failed</option>
            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
        </select>
        <button type="submit" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition bg-blue-600 hover:bg-blue-700 text-white">Search</button>
        @if(request()->hasAny(['search','status']))
            <a href="{{ route('admin.results.index') }}" class="text-sm transition text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300">Clear</a>
        @endif
    </form>
    <p class="text-sm text-slate-400 dark:text-slate-500">{{ $attempts->total() }} attempts</p>
</div>

<div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">User</th>
                <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Quiz</th>
                <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Course</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Score</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Correct</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Status</th>
                <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Date</th>
                <th class="text-right px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
            @forelse ($attempts as $attempt)
                <tr class="transition-colors group hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 bg-blue-100 dark:bg-blue-900/40">
                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400">{{ strtoupper(substr($attempt->user->name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800 dark:text-slate-100">{{ $attempt->user->name }}</p>
                                <p class="text-xs text-slate-400 dark:text-slate-500">{{ $attempt->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <p class="font-medium text-slate-700 dark:text-slate-300">{{ $attempt->quiz->title }}</p>
                    </td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                     bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                            {{ $attempt->quiz->course->title }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($attempt->score !== null)
                            <span class="font-bold text-lg {{ $attempt->is_passed ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                                {{ $attempt->score }}%
                            </span>
                        @else
                            <span class="text-xs text-slate-400 dark:text-slate-600">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center text-xs text-slate-600 dark:text-slate-400">
                        @if($attempt->correct_answers !== null)
                            {{ $attempt->correct_answers }} / {{ $attempt->total_questions }}
                        @else —
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($attempt->submitted_at === null)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold
                                         bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                In Progress
                            </span>
                        @elseif($attempt->is_passed)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                         bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400">
                                ✓ Passed
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                         bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-400">
                                ✗ Failed
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-xs text-slate-500 dark:text-slate-400">{{ $attempt->started_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.results.show', $attempt) }}"
                           class="p-1.5 rounded-lg transition-colors opacity-0 group-hover:opacity-100
                                  text-slate-300 hover:text-blue-600 hover:bg-blue-50
                                  dark:text-slate-600 dark:hover:text-blue-400 dark:hover:bg-blue-900/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-16 text-center text-sm text-slate-400 dark:text-slate-600">No results found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($attempts->hasPages())
        <div class="px-6 py-4 border-t border-slate-50 dark:border-slate-800">{{ $attempts->links() }}</div>
    @endif
</div>

@endsection
