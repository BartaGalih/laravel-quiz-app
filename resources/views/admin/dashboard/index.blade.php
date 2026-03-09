@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview of your quiz platform')

@section('header-actions')
    <a href="{{ route('admin.courses.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-colors shadow-sm
              bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200 dark:shadow-blue-900/40">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
        New Course
    </a>
@endsection

@section('content')

{{-- ── Stats Row ──────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-admin.stat-card label="Total Users"    :value="$stats['total_users']"    icon="users"          color="blue"    :change="$stats['new_users_this_month']" change-label="this month" />
    <x-admin.stat-card label="Active Courses" :value="$stats['total_courses']"  icon="academic-cap"   color="emerald" :change="$stats['published_courses']"    change-label="published"  />
    <x-admin.stat-card label="Total Quizzes"  :value="$stats['total_quizzes']"  icon="clipboard-list" color="violet"  :change="$stats['total_questions']"       change-label="questions"  />
    <x-admin.stat-card label="Attempts Today" :value="$stats['attempts_today']" icon="chart-bar"      color="amber"   :change="$stats['pass_rate']"             change-label="% pass rate"/>
</div>

{{-- ── Main layout ─────────────────────────────────────────────────────────── --}}
<div class="grid lg:grid-cols-3 gap-4 items-start">

    {{-- ── Course Grid ──────────────────────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-3">

        <div class="flex items-center justify-between mb-1">
            <h2 class="font-bold text-slate-800 dark:text-slate-100">All Courses</h2>
            <div class="flex items-center gap-3">
                <button onclick="expandAll()" class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">Expand all</button>
                <span class="text-slate-200 dark:text-slate-700">|</span>
                <button onclick="collapseAll()" class="text-xs font-semibold text-slate-400 hover:text-slate-600 dark:text-slate-600 dark:hover:text-slate-400 transition-colors">Collapse all</button>
            </div>
        </div>

        @forelse ($recentCourses as $course)
            @php
                $totalItems = $course->materials_count + $course->quizzes_count;
                $iconColors = [
                    'code'     => 'bg-blue-50   text-blue-500   dark:bg-blue-900/30   dark:text-blue-400',
                    'design'   => 'bg-violet-50  text-violet-500 dark:bg-violet-900/30 dark:text-violet-400',
                    'math'     => 'bg-emerald-50 text-emerald-500 dark:bg-emerald-900/30 dark:text-emerald-400',
                    'science'  => 'bg-cyan-50    text-cyan-500   dark:bg-cyan-900/30   dark:text-cyan-400',
                    'language' => 'bg-amber-50   text-amber-500  dark:bg-amber-900/30  dark:text-amber-400',
                    'other'    => 'bg-slate-100  text-slate-500  dark:bg-slate-800     dark:text-slate-400',
                ];
                $ic = $iconColors[$course->icon_type] ?? $iconColors['other'];
            @endphp

            <div class="course-card rounded-2xl border overflow-hidden transition-shadow hover:shadow-md
                        bg-white border-slate-100 hover:shadow-slate-100
                        dark:bg-slate-900 dark:border-slate-800 dark:hover:shadow-black/20"
                 data-course-id="{{ $course->id }}">

                {{-- Card header --}}
                <button type="button"
                        onclick="toggleCourse({{ $course->id }})"
                        class="w-full flex items-center gap-4 px-5 py-4 text-left group">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $ic }}">
                        @if($course->icon_type === 'code')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        @elseif($course->icon_type === 'design')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        @elseif($course->icon_type === 'math')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-semibold text-slate-800 dark:text-slate-100 group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">
                                {{ $course->title }}
                            </p>
                            <span @class([
                                'inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold',
                                'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' => $course->is_published,
                                'bg-slate-100  text-slate-400  dark:bg-slate-800     dark:text-slate-500'    => !$course->is_published,
                            ])>
                                {{ $course->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3 mt-1 text-xs text-slate-400 dark:text-slate-500">
                            <span>{{ $course->materials_count }} material{{ $course->materials_count !== 1 ? 's' : '' }}</span>
                            <span class="text-slate-200 dark:text-slate-700">·</span>
                            <span>{{ $course->quizzes_count }} quiz{{ $course->quizzes_count !== 1 ? 'zes' : '' }}</span>
                            <span class="text-slate-200 dark:text-slate-700">·</span>
                            <span>{{ $course->enrollments_count }} enrolled</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0" onclick="event.stopPropagation()">
                        <a href="{{ route('admin.courses.edit', $course) }}"
                           class="p-1.5 rounded-lg transition-colors text-slate-300 hover:text-amber-500 hover:bg-amber-50 dark:text-slate-600 dark:hover:text-amber-400 dark:hover:bg-amber-900/30"
                           title="Edit course">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.courses.show', $course) }}"
                           class="p-1.5 rounded-lg transition-colors text-slate-300 hover:text-blue-500 hover:bg-blue-50 dark:text-slate-600 dark:hover:text-blue-400 dark:hover:bg-blue-900/30"
                           title="View detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>

                    <svg id="chevron-{{ $course->id }}"
                         class="w-4 h-4 flex-shrink-0 transition-transform duration-200 text-slate-300 dark:text-slate-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Expandable content --}}
                <div id="content-{{ $course->id }}" class="course-content hidden border-t border-slate-50 dark:border-slate-800">

                    @if($totalItems === 0)
                        <div class="px-5 py-6 text-center text-sm text-slate-400 dark:text-slate-600">
                            No materials or quizzes yet.
                            <a href="{{ route('admin.courses.show', $course) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Add content →</a>
                        </div>
                    @else
                        @if($course->materials->count() > 0)
                            <div class="px-5 pt-3 pb-1">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">Materials</p>
                            </div>
                            @foreach($course->materials as $material)
                                <div class="flex items-center gap-3 px-5 py-2.5 transition-colors hover:bg-slate-50/70 dark:hover:bg-slate-800/50">
                                    @if($material->type === 'document')
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 bg-red-50 dark:bg-red-900/20">
                                            <svg class="w-4 h-4 text-red-400 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 bg-blue-50 dark:bg-blue-900/20">
                                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium truncate text-slate-700 dark:text-slate-300">{{ $material->title }}</p>
                                        <p class="text-xs text-slate-400 dark:text-slate-500">
                                            @if($material->type === 'document') {{ $material->page_count ?? '—' }} pages
                                            @else {{ $material->formatted_duration ?: '—' }}
                                            @endif
                                        </p>
                                    </div>
                                    <span class="text-[10px] font-semibold uppercase tracking-wide px-2 py-1 rounded-md
                                                 {{ $material->type === 'document'
                                                    ? 'bg-red-50 text-red-400 dark:bg-red-900/20 dark:text-red-400'
                                                    : 'bg-blue-50 text-blue-400 dark:bg-blue-900/20 dark:text-blue-400' }}">
                                        {{ $material->type }}
                                    </span>
                                </div>
                            @endforeach
                        @endif

                        @if($course->quizzes->count() > 0)
                            <div class="px-5 pt-3 pb-1 {{ $course->materials->count() > 0 ? 'mt-1 border-t border-slate-50 dark:border-slate-800' : '' }}">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">Quizzes</p>
                            </div>
                            @foreach($course->quizzes as $quiz)
                                <div class="flex items-center gap-3 px-5 py-2.5 transition-colors group/item hover:bg-slate-50/70 dark:hover:bg-slate-800/50">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 bg-green-50 dark:bg-green-900/20">
                                        <svg class="w-4 h-4 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium truncate text-slate-700 dark:text-slate-300">{{ $quiz->title }}</p>
                                        <p class="text-xs text-slate-400 dark:text-slate-500">
                                            {{ $quiz->questions_count }} questions · {{ $quiz->duration_minutes }} min
                                            @if($quiz->due_date) · Due {{ $quiz->due_date->format('d M') }} @endif
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span @class([
                                            'text-[10px] font-semibold uppercase tracking-wide px-2 py-1 rounded-md',
                                            'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400' => $quiz->is_published,
                                            'bg-slate-100  text-slate-400  dark:bg-slate-800     dark:text-slate-500'    => !$quiz->is_published,
                                        ])>{{ $quiz->is_published ? 'Live' : 'Draft' }}</span>
                                        <a href="{{ route('admin.quizzes.show', $quiz) }}"
                                           class="p-1 rounded transition-colors opacity-0 group-hover/item:opacity-100 text-slate-300 hover:text-blue-500 dark:text-slate-600 dark:hover:text-blue-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="flex items-center justify-between px-5 py-2.5 mt-1 border-t
                                    bg-slate-50/50 border-slate-50
                                    dark:bg-slate-800/40 dark:border-slate-800">
                            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $totalItems }} item{{ $totalItems !== 1 ? 's' : '' }} total</p>
                            <a href="{{ route('admin.courses.show', $course) }}"
                               class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                Manage course →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-2xl border px-6 py-16 text-center
                        bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
                <svg class="w-12 h-12 mx-auto mb-3 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <p class="font-semibold mb-1 text-slate-500 dark:text-slate-400">No courses yet</p>
                <a href="{{ route('admin.courses.create') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Create your first course →</a>
            </div>
        @endforelse
    </div>

    {{-- ── Right sidebar ────────────────────────────────────────────────────── --}}
    <div class="space-y-4">

        {{-- Recent attempts --}}
        <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-50 dark:border-slate-800">
                <h2 class="font-bold text-slate-800 dark:text-slate-100">Recent Attempts</h2>
                <a href="{{ route('admin.results.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">View all →</a>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse ($recentAttempts as $attempt)
                    <div class="px-5 py-3.5 transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold truncate text-slate-700 dark:text-slate-200">{{ $attempt->user->name }}</p>
                                <p class="text-xs mt-0.5 truncate text-slate-400 dark:text-slate-500">{{ $attempt->quiz->title }}</p>
                                <p class="text-xs mt-0.5 text-slate-300 dark:text-slate-600">{{ $attempt->started_at->diffForHumans() }}</p>
                            </div>
                            <span @class([
                                'text-xs font-bold flex-shrink-0 mt-0.5',
                                'text-emerald-600 dark:text-emerald-400' => $attempt->is_passed === true,
                                'text-red-500    dark:text-red-400'      => $attempt->is_passed === false,
                                'text-slate-400  dark:text-slate-500'    => $attempt->is_passed === null,
                            ])>
                                {{ $attempt->score !== null ? $attempt->score . '%' : '…' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-sm text-slate-400 dark:text-slate-600">No attempts yet.</div>
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="rounded-2xl border px-5 py-4 bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
            <p class="text-xs font-bold uppercase tracking-widest mb-3 text-slate-400 dark:text-slate-600">Quick Actions</p>
            <div class="space-y-1.5">
                @foreach([
                    ['route' => 'admin.courses.create', 'label' => 'New Course',    'icon' => 'plus'],
                    ['route' => 'admin.quizzes.create', 'label' => 'New Quiz',      'icon' => 'clipboard'],
                    ['route' => 'admin.users.index',    'label' => 'Manage Users',  'icon' => 'users'],
                    ['route' => 'admin.results.index',  'label' => 'View Results',  'icon' => 'chart'],
                ] as $link)
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                              text-slate-600 hover:bg-blue-50 hover:text-blue-700
                              dark:text-slate-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-300">
                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($link['icon'] === 'plus')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            @elseif($link['icon'] === 'clipboard')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            @elseif($link['icon'] === 'users')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            @endif
                        </svg>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleCourse(id) {
        var content = document.getElementById('content-' + id);
        var chevron = document.getElementById('chevron-' + id);
        var hidden  = content.classList.contains('hidden');
        content.classList.toggle('hidden', !hidden);
        chevron.style.transform = hidden ? 'rotate(180deg)' : '';
    }
    function expandAll() {
        document.querySelectorAll('.course-content').forEach(function(el) { el.classList.remove('hidden'); });
        document.querySelectorAll('[id^="chevron-"]').forEach(function(el) { el.style.transform = 'rotate(180deg)'; });
    }
    function collapseAll() {
        document.querySelectorAll('.course-content').forEach(function(el) { el.classList.add('hidden'); });
        document.querySelectorAll('[id^="chevron-"]').forEach(function(el) { el.style.transform = ''; });
    }
</script>
@endpush
