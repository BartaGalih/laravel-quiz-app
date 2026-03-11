<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-poppins">

    <div class="min-h-screen bg-gray-100">

        {{-- TOP NAVBAR --}}
        <x-top-navbar  :breadcrumbs="$breadcrumbs"/>

        {{-- SEARCH & SORT BAR --}}
        <div class="flex w-full w-screen main-content">
            <div class="left-part flex-1 min-w-0">
                {{-- MAIN CONTENT --}}
                <div class="flex gap-0">

                    <main class="flex-1 border-r border-gray-200">

                        {{-- Course Title --}}
                        <div class="bg-white px-8 flex items-center border-b border-gray-200  h-16">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $course['title'] }}</h1>
                        </div>

                        {{-- Progress Section --}}
                        <div class="bg-gray-100 px-8 py-5 border-b border-gray-200">
                            {{-- Meta --}}
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                <span>{{ $course['materials_count'] }} Material</span>
                                <span class="text-gray-400">•</span>
                                <span>{{ $course['quizzes_count'] }} quizzes</span>
                            </div>

                            {{-- Progress Bar --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="bg-gray-400 text-white text-sm font-bold rounded-lg px-3 py-2 flex-shrink-0">
                                    {{ $course['progress'] }}%
                                </div>
                                <span class="text-sm text-gray-500 flex-shrink-0">Completed</span>
                                <div class="flex-1 bg-gray-300 rounded-full h-3 overflow-hidden">
                                    <div class="bg-blue-400 h-3 rounded-full transition-all duration-500"
                                        style="width: {{ $course['progress'] }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Content Items --}}
                        <div class="px-8 py-6 space-y-4">

                            @foreach ($items as $item)
                                @if ($item['type'] === 'material')
                                    {{-- PDF Material --}}
                                    <div
                                        class="bg-white rounded-2xl border border-gray-200 shadow-sm px-5 py-4 flex items-center gap-4 hover:shadow-md transition-shadow cursor-pointer">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0">
                                            <x-heroicon-s-document-text class="w-6 h-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-bold text-gray-900">{{ $item['title'] }}</p>
                                            <p class="text-sm text-gray-400">Page: {{ $item['pages'] }} pages</p>
                                        </div>
                                        @if ($item['completed'])
                                            <div
                                                class="w-9 h-9 rounded-lg bg-green-500 flex items-center justify-center flex-shrink-0">
                                                <x-heroicon-s-check class="w-5 h-5 text-white" />
                                            </div>
                                        @endif
                                    </div>
                                @elseif ($item['type'] === 'video')
                                    {{-- Video Material --}}
                                    <div
                                        class="bg-white rounded-2xl border border-gray-200 shadow-sm px-5 py-4 flex items-center gap-4 hover:shadow-md transition-shadow cursor-pointer">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center flex-shrink-0">
                                            <x-heroicon-s-film class="w-6 h-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-bold text-gray-900">{{ $item['title'] }}</p>
                                            <p class="text-sm text-gray-400">Duration : {{ $item['duration'] }}</p>
                                        </div>
                                        @if ($item['completed'])
                                            <div
                                                class="w-9 h-9 rounded-lg bg-green-500 flex items-center justify-center flex-shrink-0">
                                                <x-heroicon-s-check class="w-5 h-5 text-white" />
                                            </div>
                                        @endif
                                    </div>
                                @elseif ($item['type'] === 'quiz')
                                    {{-- Quiz --}}
                                    <div onclick="window.location.href='{{ route('quiz.preview', $item['id']) }}'"
                                        class="bg-white rounded-2xl border border-gray-200 shadow-sm px-5 py-4 flex items-center gap-4 hover:shadow-md transition-shadow cursor-pointer">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-green-500 flex items-center justify-center flex-shrink-0">
                                            <x-heroicon-s-clipboard-document-list class="w-6 h-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-bold text-gray-900">{{ $item['title'] }}</p>
                                            <p class="text-sm text-gray-400">{{ $item['questions'] }} Questions •
                                                {{ $item['duration'] }} minutes</p>
                                        </div>
                                        @if ($item['completed'])
                                            <div
                                                class="w-9 h-9 rounded-lg bg-green-500 flex items-center justify-center flex-shrink-0">
                                                <x-heroicon-s-check class="w-5 h-5 text-white" />
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </main>

                </div>
            </div>
            {{-- TO-DO SIDEBAR --}}
            <aside class="w-80 bg-white flex-shrink-0">

                {{-- Sidebar Header --}}
                <div class="w-80 bg-white px-6 flex-shrink-0">
                    <div class="flex items-center gap-2 mb-5 h-16">
                        <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-orange-400" />
                        <h2 class="text-2xl font-bold text-gray-900">To-do</h2>
                    </div>
                </div>
                <div class="w-80 bg-white px-6 flex-shrink-0">
                    <div class="space-y-3 h-screen overflow-y-auto pr-1">
                        @foreach ($todos as $todo)
                            <div class="flex items-stretch border border-gray-200 rounded-xl overflow-hidden">
                                <div class="w-1.5 bg-orange-400 flex-shrink-0 rounded-l-xl"></div>
                                <div class="flex-1 flex items-center justify-between px-4 py-3">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $todo['title'] }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">Due : {{ $todo['due'] }}</p>
                                    </div>
                                    @if ($todo['completed'])
                                        <div
                                            class="w-6 h-6 rounded bg-green-500 flex items-center justify-center flex-shrink-0 ml-3">
                                            <x-heroicon-s-check class="w-4 h-4 text-white" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </aside>

        </div>
    </div>
</body>

</html>
