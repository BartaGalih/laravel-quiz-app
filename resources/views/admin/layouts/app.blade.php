<!DOCTYPE html>
<html lang="en" class="h-full">
{{--
    DARK MODE IMPLEMENTATION NOTES
    ═══════════════════════════════════════════════════════════════════════════
    Strategy  : Tailwind "class" strategy — `.dark` toggled on <html>.
    Persistence: localStorage key "theme" → "dark" | "light".
    Anti-flash : Inline <script> in <head> reads localStorage BEFORE first
                 paint and applies .dark immediately. No FOUC ever occurs.
    Toggle btn : Sun/Moon icon button in the topbar header.
    ═══════════════════════════════════════════════════════════════════════════
--}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Quiz App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.ts'])

    {{--
        ANTI-FLASH SCRIPT — must be inline, must be in <head>.
        Runs synchronously before any body element is painted.
        Reads persisted preference → adds .dark to <html> if needed.
    --}}
    <script>
        (function () {
            var saved      = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body class="h-full bg-slate-50 dark:bg-slate-950 font-sans antialiased transition-colors duration-200"
      style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="flex h-full">

        {{-- ── Sidebar ─────────────────────────────────────────────────────── --}}
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col shadow-sm transition-transform duration-300
                      bg-white border-r border-slate-100
                      dark:bg-slate-900 dark:border-slate-800
                      lg:translate-x-0 -translate-x-full">

            {{-- Logo --}}
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-100 dark:border-slate-800">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-extrabold text-slate-800 dark:text-slate-100 leading-none">QuizApp</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Admin Panel</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-0.5">
                <p class="px-3 pt-2 pb-1.5 text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">
                    Main
                </p>
                <x-admin.nav-item route="admin.dashboard"     icon="home"           label="Dashboard" />
                <x-admin.nav-item route="admin.courses.index" icon="academic-cap"   label="Courses" />
                <x-admin.nav-item route="admin.quizzes.index" icon="clipboard-list" label="Quizzes" />

                <p class="px-3 pt-4 pb-1.5 text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600">
                    Manage
                </p>
                <x-admin.nav-item route="admin.users.index"   icon="users"     label="Users" />
                <x-admin.nav-item route="admin.results.index" icon="chart-bar" label="Results" />
            </nav>

            {{-- Bottom: user info + logout --}}
            <div class="px-4 py-4 border-t border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/60 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 truncate">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" title="Logout"
                                class="text-slate-400 hover:text-red-500 dark:text-slate-600 dark:hover:text-red-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ── Main content ─────────────────────────────────────────────────── --}}
        <div class="flex-1 flex flex-col lg:ml-64 min-h-screen">

            {{-- Top bar --}}
            <header class="sticky top-0 z-40 backdrop-blur-md border-b px-6 py-4 flex items-center justify-between
                           bg-white/80 border-slate-100
                           dark:bg-slate-900/80 dark:border-slate-800">
                <div class="flex items-center gap-4">
                    {{-- Mobile menu --}}
                    <button id="sidebar-toggle"
                            class="lg:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-slate-800 dark:text-slate-100">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('breadcrumb')
                            <p class="text-xs text-slate-400 dark:text-slate-500">@yield('breadcrumb')</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @yield('header-actions')

                    {{--
                        DARK MODE TOGGLE BUTTON
                        Light mode → Moon icon visible (click to go dark)
                        Dark  mode → Sun  icon visible (click to go light)
                    --}}
                    <button id="theme-toggle"
                            type="button"
                            aria-label="Switch to dark mode"
                            class="p-2 rounded-xl border transition-colors
                                   border-slate-200 hover:bg-slate-100 text-slate-500 hover:text-slate-700
                                   dark:border-slate-700 dark:hover:bg-slate-800 dark:text-slate-400 dark:hover:text-slate-200 cursor-pointer">
                        {{-- Moon: visible in light mode --}}
                        <svg id="icon-moon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        {{-- Sun: visible in dark mode --}}
                        <svg id="icon-sun" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 p-6">

                @if (session('success'))
                    <div class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm
                                bg-emerald-50 border border-emerald-200 text-emerald-700
                                dark:bg-emerald-900/20 dark:border-emerald-700/50 dark:text-emerald-400">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm
                                bg-red-50 border border-red-200 text-red-700
                                dark:bg-red-900/20 dark:border-red-700/50 dark:text-red-400">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Mobile sidebar overlay --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/30 z-40 lg:hidden hidden"
         onclick="closeSidebar()">
    </div>

    <script>
        // ── Sidebar ───────────────────────────────────────────────────────────
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        document.getElementById('sidebar-toggle')?.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        // ── Theme toggle ──────────────────────────────────────────────────────
        var html      = document.documentElement;
        var toggleBtn = document.getElementById('theme-toggle');
        var iconMoon  = document.getElementById('icon-moon');
        var iconSun   = document.getElementById('icon-sun');

        function syncThemeUI() {
            var isDark = html.classList.contains('dark');
            iconMoon.classList.toggle('hidden',  isDark);   // hide moon when dark
            iconSun.classList.toggle('hidden',  !isDark);   // hide sun  when light
            toggleBtn.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
        }

        // Sync icons with whatever the anti-flash script applied
        syncThemeUI();

        toggleBtn.addEventListener('click', function () {
            var isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            syncThemeUI();
        });
    </script>

    @stack('scripts')
</body>
</html>
