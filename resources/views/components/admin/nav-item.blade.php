@props(['route', 'icon', 'label'])

@php
    $isActive = request()->routeIs($route) || request()->routeIs($route . '.*');
@endphp

{{--
    NAV ITEM — dark mode
    Active   light: bg-blue-50  text-blue-700
    Active   dark : bg-blue-900/40 text-blue-400
    Inactive light: text-slate-600  hover:bg-slate-50
    Inactive dark : text-slate-400  hover:bg-slate-800
--}}
<a href="{{ route($route) }}"
   @class([
       'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150',
       'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-900/40 dark:text-blue-400'
           => $isActive,
       'text-slate-600 hover:bg-slate-50 hover:text-slate-800 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200'
           => !$isActive,
   ])>

    <span @class([
        'w-5 h-5 flex-shrink-0',
        'text-blue-600 dark:text-blue-400'  => $isActive,
        'text-slate-400 dark:text-slate-500' => !$isActive,
    ])>
        @switch($icon)
            @case('home')
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                @break
            @case('academic-cap')
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
                @break
            @case('clipboard-list')
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                @break
            @case('users')
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                @break
            @case('chart-bar')
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                @break
        @endswitch
    </span>

    {{ $label }}

    @if ($isActive)
        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500 dark:bg-blue-400"></span>
    @endif
</a>
