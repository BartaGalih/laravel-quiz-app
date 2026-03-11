<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $quiz['title'] }} - Preview</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-poppins">
<div class="min-h-screen bg-gray-100">

    {{-- TOP NAVBAR --}}
    <x-top-navbar />
    {{-- PAGE CONTENT --}}
    <div class="flex min-h-[calc(100vh-73px)]">

        {{-- MAIN --}}
        <main class="flex-1 min-w-0 p-8 border-r border-gray-200 flex flex-col gap-6">

            {{-- Quiz Title Card --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-green-500 flex items-center justify-center flex-shrink-0">
                    <x-heroicon-s-clipboard-document-list class="w-8 h-8 text-white" />
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-medium mb-0.5">{{ $course['title'] }}</p>
                    <h1 class="text-2xl font-extrabold text-gray-900">{{ $quiz['title'] }}</h1>
                </div>
            </div>

            {{-- Stats Row --}}
            <div class="grid grid-cols-3 gap-5">

                {{-- Time Limit --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <x-heroicon-s-clock class="w-6 h-6 text-blue-500" />
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Time Limit</p>
                        <p class="text-xl font-bold text-gray-900">{{ $quiz['time_limit'] }} <span class="text-sm font-medium text-gray-400">minutes</span></p>
                    </div>
                </div>

                {{-- Question Count --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                        <x-heroicon-s-question-mark-circle class="w-6 h-6 text-orange-500" />
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Questions</p>
                        <p class="text-xl font-bold text-gray-900">{{ $quiz['questions_count'] }} <span class="text-sm font-medium text-gray-400">questions</span></p>
                    </div>
                </div>

                {{-- Attempts --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                        <x-heroicon-s-arrow-path class="w-6 h-6 text-purple-500" />
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Attempts</p>
                        <p class="text-xl font-bold text-gray-900">
                            {{ $quiz['user_attempts'] }} / {{ $quiz['max_attempts'] ?? '∞' }}
                            <span class="text-sm font-medium text-gray-400">used</span>
                        </p>
                    </div>
                </div>

            </div>
            {{-- Previous Attempts --}}
            @if ($attempts->count() > 0)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex flex-col gap-4">
                <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <x-heroicon-s-clock class="w-5 h-5 text-gray-400" />
                    Previous Attempts
                </h2>
                <div class="overflow-hidden rounded-xl border border-gray-100">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">#</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Date</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Score</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($attempts as $i => $attempt)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $attempt->created_at->format('D, d M Y, h:i A') }}</td>
                                <td class="px-4 py-3 font-semibold text-gray-900">{{ $attempt->score }} / {{ $quiz['questions_count'] }}</td>
                                <td class="px-4 py-3">
                                    @if ($attempt->passed)
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-600 bg-green-100 px-2.5 py-1 rounded-full">
                                            <x-heroicon-s-check-circle class="w-3.5 h-3.5" /> Passed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-red-500 bg-red-100 px-2.5 py-1 rounded-full">
                                            <x-heroicon-s-x-circle class="w-3.5 h-3.5" /> Failed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Start Button --}}
            <div class="flex justify-end">
                @if ($quiz['max_attempts'] && $quiz['user_attempts'] >= $quiz['max_attempts'])
                    <button disabled
                        class="flex items-center gap-2 bg-gray-300 text-gray-500 font-bold text-base px-8 py-3 rounded-xl cursor-not-allowed">
                        <x-heroicon-s-lock-closed class="w-5 h-5" />
                        No Attempts Left
                    </button>
                @else
                    <a href="{{--  --}}"
                        class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-bold text-base px-8 py-3 rounded-xl transition-colors">
                        Start Quiz
                        <x-heroicon-s-chevron-right class="w-5 h-5" />
                    </a>
                @endif
            </div>

        </main>

        {{-- RIGHT SIDEBAR --}}
        <aside class="w-80 bg-white flex-shrink-0 px-6 py-6">
            <div class="flex items-center gap-2 mb-5">
                <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-orange-400" />
                <h2 class="text-2xl font-bold text-gray-900">To-do</h2>
            </div>

            <div class="space-y-3">
                @foreach ($todos as $todo)
                <div class="flex items-stretch border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="w-1.5 bg-orange-400 flex-shrink-0"></div>
                    <div class="flex-1 flex items-center justify-between px-4 py-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $todo['title'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">Due : {{ $todo['due'] }}</p>
                        </div>
                        @if ($todo['completed'])
                            <div class="w-6 h-6 rounded bg-green-500 flex items-center justify-center flex-shrink-0 ml-3">
                                <x-heroicon-s-check class="w-4 h-4 text-white" />
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </aside>

    </div>
</div>
</body>
</html>