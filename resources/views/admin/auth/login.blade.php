<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Quiz App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.ts'])

    {{-- Anti-flash: same pattern as the main layout --}}
    <script>
        (function () {
            var saved       = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Dot pattern — light */
        .dot-bg {
            background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }
        /* Dot pattern — dark */
        .dark .dot-bg {
            background-image: radial-gradient(circle, #334155 1px, transparent 1px);
        }

        /* Input — light */
        .input-field {
            width: 100%; padding: .75rem 1rem; border-radius: .75rem;
            background: #f1f5fd; border: 1.5px solid transparent;
            outline: none; font-size: .875rem; transition: all .2s;
            color: #1e293b;
        }
        .input-field::placeholder { color: #94a3b8; }
        .input-field:focus {
            background: #fff; border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59,130,246,.10);
        }

        /* Input — dark */
        .dark .input-field {
            background: #1e293b; color: #e2e8f0; border-color: #334155;
        }
        .dark .input-field::placeholder { color: #475569; }
        .dark .input-field:focus {
            background: #0f172a; border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59,130,246,.15);
        }

        /* Primary button */
        .btn-primary {
            width: 100%; background: #2563eb; color: white; font-weight: 700;
            padding: .875rem 1.5rem; border-radius: .75rem; border: none;
            cursor: pointer; font-size: .9375rem; transition: all .2s;
            box-shadow: 0 4px 14px rgba(37,99,235,.25);
        }
        .btn-primary:hover {
            background: #1d4ed8; box-shadow: 0 6px 20px rgba(37,99,235,.35);
            transform: translateY(-1px);
        }
        .btn-primary:active { transform: translateY(0); }
    </style>
</head>

{{--
    Page background:
    light → bg-slate-50 dot-bg
    dark  → bg-slate-950 dark:dot-bg (dot colour overridden via .dark .dot-bg CSS)
--}}
<body class="h-full bg-slate-50 dark:bg-slate-950 dot-bg flex items-center justify-center p-4 transition-colors duration-200">

    {{-- Theme toggle — top-right corner --}}
    <div class="fixed top-4 right-4">
        <button id="theme-toggle"
                type="button"
                aria-label="Switch to dark mode"
                class="p-2 rounded-xl border transition-colors
                       border-slate-200 bg-white hover:bg-slate-100 text-slate-500
                       dark:border-slate-700 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-slate-400">
            <svg id="icon-moon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
            <svg id="icon-sun" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </button>
    </div>

    <div class="w-full max-w-[420px]">
        {{--
            Card:
            light → bg-white  border-slate-100 shadow-slate-200/60
            dark  → bg-slate-900 border-slate-800 shadow-black/40
        --}}
        <div class="rounded-2xl shadow-xl border overflow-hidden
                    bg-white border-slate-100 shadow-slate-200/60
                    dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/40">

            {{-- Gradient top accent --}}
            <div class="h-1.5 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>

            <div class="px-8 pt-8 pb-9">
                <div class="mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mb-5 shadow-lg shadow-blue-200 dark:shadow-blue-900/40">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-800 dark:text-slate-100">Welcome back</h1>
                    <p class="text-sm mt-1 text-slate-400 dark:text-slate-500">Sign in to the Quiz App admin panel</p>
                </div>

                @if ($errors->any())
                    <div class="mb-5 flex items-start gap-3 px-4 py-3.5 rounded-xl
                                bg-red-50 border border-red-200
                                dark:bg-red-900/20 dark:border-red-700/50">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-red-500 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4" novalidate>
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               required autocomplete="email"
                               class="input-field" placeholder="admin@example.com">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                            <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="password-input"
                                   required autocomplete="current-password"
                                   class="input-field pr-10" placeholder="••••••••">
                            {{-- Password visibility toggle --}}
                            <button type="button"
                                    onclick="(function(i){i.type=i.type==='password'?'text':'password'})(document.getElementById('password-input'))"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 transition-colors
                                           text-slate-400 hover:text-slate-600
                                           dark:text-slate-600 dark:hover:text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember"
                                   class="w-4 h-4 rounded text-blue-600 border-slate-300 dark:border-slate-600
                                          focus:ring-blue-500 focus:ring-offset-0 dark:bg-slate-800 dark:checked:bg-blue-600">
                            <span class="text-sm text-slate-600 dark:text-slate-400">Remember me</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-primary">Sign In</button>
                    </div>
                </form>

                <div class="mt-6 pt-5 border-t text-center text-sm
                            border-slate-100 text-slate-400
                            dark:border-slate-800 dark:text-slate-600">
                    Not an admin?
                    <a href="{{ route('login') }}"
                       class="font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                        User Login
                    </a>
                </div>
            </div>
        </div>

        <p class="text-center text-xs mt-6 text-slate-400 dark:text-slate-600">
            © {{ date('Y') }} Quiz App. All rights reserved.
        </p>
    </div>

    <script>
        var html     = document.documentElement;
        var btn      = document.getElementById('theme-toggle');
        var iconMoon = document.getElementById('icon-moon');
        var iconSun  = document.getElementById('icon-sun');

        function syncThemeUI() {
            var isDark = html.classList.contains('dark');
            iconMoon.classList.toggle('hidden',  isDark);
            iconSun.classList.toggle('hidden',  !isDark);
            btn.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
        }

        syncThemeUI();

        btn.addEventListener('click', function () {
            var isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            syncThemeUI();
        });
    </script>
</body>
</html>
