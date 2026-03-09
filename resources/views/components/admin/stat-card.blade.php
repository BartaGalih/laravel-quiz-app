@props(['label', 'value', 'icon', 'color' => 'blue', 'change' => null, 'changeLabel' => ''])

@php
    /*
     * Each color maps to:
     *   bg     → icon container background (light / dark)
     *   icon   → icon colour (light / dark)
     *   badge  → change-label text colour (light / dark)
     *
     * Dark mode palette chosen to be visually distinct but not harsh.
     */
    $colorMap = [
        'blue'    => [
            'bg'    => 'bg-blue-50   dark:bg-blue-900/30',
            'icon'  => 'text-blue-500   dark:text-blue-400',
            'badge' => 'text-blue-600   dark:text-blue-400',
        ],
        'emerald' => [
            'bg'    => 'bg-emerald-50 dark:bg-emerald-900/30',
            'icon'  => 'text-emerald-500 dark:text-emerald-400',
            'badge' => 'text-emerald-600 dark:text-emerald-400',
        ],
        'violet'  => [
            'bg'    => 'bg-violet-50  dark:bg-violet-900/30',
            'icon'  => 'text-violet-500  dark:text-violet-400',
            'badge' => 'text-violet-600  dark:text-violet-400',
        ],
        'amber'   => [
            'bg'    => 'bg-amber-50   dark:bg-amber-900/30',
            'icon'  => 'text-amber-500   dark:text-amber-400',
            'badge' => 'text-amber-600   dark:text-amber-400',
        ],
    ];
    $c = $colorMap[$color] ?? $colorMap['blue'];
@endphp

{{--
    Card: light → bg-white border-slate-100
          dark  → bg-slate-900 border-slate-800
--}}
<div class="rounded-2xl border px-5 py-5 hover:shadow-md transition-shadow
            bg-white border-slate-100 hover:shadow-slate-100
            dark:bg-slate-900 dark:border-slate-800 dark:hover:shadow-slate-900">

    <div class="flex items-start justify-between mb-4">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $c['bg'] }}">
            @switch($icon)
                @case('users')
                    <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    @break
                @case('academic-cap')
                    <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    @break
                @case('clipboard-list')
                    <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    @break
                @case('chart-bar')
                    <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    @break
            @endswitch
        </div>
    </div>

    <p class="text-2xl font-extrabold leading-none text-slate-800 dark:text-slate-100">
        {{ number_format($value) }}
    </p>
    <p class="text-sm mt-1 text-slate-500 dark:text-slate-400">{{ $label }}</p>

    @if ($change !== null)
        <p class="text-xs font-semibold mt-2 {{ $c['badge'] }}">{{ $change }} {{ $changeLabel }}</p>
    @endif
</div>
