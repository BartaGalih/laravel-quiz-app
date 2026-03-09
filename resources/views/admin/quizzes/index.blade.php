@extends('admin.layouts.app')
@section('title', 'Quizzes')
@section('page-title', 'Quizzes')
@section('breadcrumb', 'Manage all quizzes')

@section('header-actions')
    <a href="{{ route('admin.quizzes.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-colors shadow-sm
              bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200 dark:shadow-blue-900/40">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
        Add Quiz
    </a>
@endsection

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
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search quizzes..."
                   class="{{ $inputClass }} w-full pl-9 pr-4 py-2.5">
        </div>
        <button type="submit" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition bg-blue-600 hover:bg-blue-700 text-white">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.quizzes.index') }}" class="text-sm transition text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300">Clear</a>
        @endif
    </form>
    <p class="text-sm text-slate-400 dark:text-slate-500">{{ $quizzes->total() }} quizzes</p>
</div>

<div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Quiz</th>
                <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Course</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Questions</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Duration</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Attempts</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Due Date</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Status</th>
                <th class="text-right px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
            @forelse ($quizzes as $quiz)
                <tr class="transition-colors group hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                    <td class="px-6 py-4">
                        <p class="font-semibold text-slate-800 dark:text-slate-100">{{ $quiz->title }}</p>
                        <p class="text-xs mt-0.5 text-slate-400 dark:text-slate-500">Pass: {{ $quiz->passing_score }}%</p>
                    </td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                     bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                            {{ $quiz->course->title }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $quiz->questions_count }}</td>
                    <td class="px-4 py-4 text-center text-slate-600 dark:text-slate-400">{{ $quiz->duration_minutes }} min</td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $quiz->attempts_count }}</td>
                    <td class="px-4 py-4 text-center text-xs text-slate-500 dark:text-slate-400">
                        {{ $quiz->due_date ? $quiz->due_date->format('d M Y') : '—' }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span @class([
                            'inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold',
                            'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400' => $quiz->is_published,
                            'bg-slate-100  text-slate-500  dark:bg-slate-800     dark:text-slate-400'    => !$quiz->is_published,
                        ])>{{ $quiz->is_published ? 'Published' : 'Draft' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.quizzes.show', $quiz) }}"
                               class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:text-slate-600 dark:hover:text-blue-400 dark:hover:bg-blue-900/30" title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.quizzes.edit', $quiz) }}"
                               class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-amber-600 hover:bg-amber-50 dark:text-slate-600 dark:hover:text-amber-400 dark:hover:bg-amber-900/30" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.quizzes.destroy', $quiz) }}"
                                  onsubmit="return confirm('Delete this quiz and all its questions?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-red-600 hover:bg-red-50 dark:text-slate-600 dark:hover:text-red-400 dark:hover:bg-red-900/30" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-16 text-center text-sm text-slate-400 dark:text-slate-600">
                        No quizzes found.
                        <a href="{{ route('admin.quizzes.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline ml-1">Create one</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($quizzes->hasPages())
        <div class="px-6 py-4 border-t border-slate-50 dark:border-slate-800">{{ $quizzes->links() }}</div>
    @endif
</div>

@endsection
