@extends('admin.layouts.app')
@section('title', 'Courses')
@section('page-title', 'Courses')
@section('breadcrumb', 'Manage all courses')

@section('header-actions')
    <a href="{{ route('admin.courses.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-colors shadow-sm
              bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200 dark:shadow-blue-900/40">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
        Add Course
    </a>
@endsection

@section('content')

@php
$inputClass  = 'text-sm rounded-xl transition focus:outline-none
                bg-slate-50 border border-slate-200 text-slate-700 placeholder-slate-400
                focus:border-blue-400 focus:ring-2 focus:ring-blue-100
                dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:placeholder-slate-500
                dark:focus:border-blue-500 dark:focus:ring-blue-900/30';
@endphp

{{-- Search bar --}}
<div class="rounded-2xl border mb-4 px-5 py-4 flex flex-wrap items-center gap-3
            bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <form method="GET" class="flex-1 flex items-center gap-3 min-w-0">
        <div class="relative flex-1 max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 dark:text-slate-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..."
                   class="{{ $inputClass }} w-full pl-9 pr-4 py-2.5">
        </div>
        <select name="status" onchange="this.form.submit()" class="{{ $inputClass }} px-3 py-2.5">
            <option value="">All Status</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
        </select>
        <button type="submit"
                class="px-4 py-2.5 text-sm font-semibold rounded-xl transition bg-blue-600 hover:bg-blue-700 text-white">
            Search
        </button>
        @if(request()->hasAny(['search','status']))
            <a href="{{ route('admin.courses.index') }}"
               class="text-sm transition text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300">
                Clear
            </a>
        @endif
    </form>
    <p class="text-sm text-slate-400 dark:text-slate-500">{{ $courses->total() }} courses</p>
</div>

{{-- Table --}}
<div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Course</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Materials</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Quizzes</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Enrollments</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Status</th>
                <th class="text-right px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
            @forelse ($courses as $course)
                <tr class="transition-colors group hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 bg-blue-50 dark:bg-blue-900/30">
                                <svg class="w-4 h-4 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800 dark:text-slate-100">{{ $course->title }}</p>
                                @if($course->description)
                                    <p class="text-xs mt-0.5 line-clamp-1 text-slate-400 dark:text-slate-500">{{ $course->description }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $course->materials_count }}</td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $course->quizzes_count }}</td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $course->enrollments_count }}</td>
                    <td class="px-4 py-4 text-center">
                        <form method="POST" action="{{ route('admin.courses.toggle-publish', $course) }}" class="inline">
                            @csrf
                            <button type="submit" @class([
                                'inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors cursor-pointer',
                                'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-400 dark:hover:bg-emerald-900/40'
                                    => $course->is_published,
                                'bg-slate-100 text-slate-500 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700'
                                    => !$course->is_published,
                            ])>
                                {{ $course->is_published ? '✓ Published' : '○ Draft' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.courses.show', $course) }}"
                               class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:text-slate-600 dark:hover:text-blue-400 dark:hover:bg-blue-900/30"
                               title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.courses.edit', $course) }}"
                               class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-amber-600 hover:bg-amber-50 dark:text-slate-600 dark:hover:text-amber-400 dark:hover:bg-amber-900/30"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                  onsubmit="return confirm('Delete this course and all its contents?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-red-600 hover:bg-red-50 dark:text-slate-600 dark:hover:text-red-400 dark:hover:bg-red-900/30"
                                        title="Delete">
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
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-2 text-slate-400 dark:text-slate-600">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            <p class="font-semibold text-slate-500 dark:text-slate-400">No courses found</p>
                            <p class="text-sm">
                                <a href="{{ route('admin.courses.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Create your first course</a>
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($courses->hasPages())
        <div class="px-6 py-4 border-t border-slate-50 dark:border-slate-800">
            {{ $courses->links() }}
        </div>
    @endif
</div>

@endsection
