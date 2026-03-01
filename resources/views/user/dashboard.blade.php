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
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Courses</h1>
        <div class="flex items-center gap-2 text-gray-700">
            <span class="text-xl font-semibold">Settings</span>
            <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center">
               <x-heroicon-s-cog-6-tooth class="w-5 h-5 text-gray-700"/>
            </div>
        </div>
    </header>

    {{-- SEARCH & SORT BAR --}}
    <div class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-4">
        {{-- Search --}}
        <div class="flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 w-80 bg-white">
           <x-heroicon-s-magnifying-glass class="w-5 h-5 text-gray-400"/>
            <input
                type="text"
                placeholder="Search courses ..."
                class="text-sm text-gray-500 outline-none bg-transparent w-full placeholder-gray-400"
            />
        </div>

        {{-- Sort by --}}
        <div class="flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 bg-white">
            <span class="text-sm text-gray-500">Sort by :</span>
            <select class="text-sm font-semibold text-gray-800 bg-transparent outline-none cursor-pointer">
                <option>Progress</option>
                <option>Name</option>
                <option>Date</option>
            </select>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="flex gap-0">

        {{-- COURSE GRID --}}
        <main class="flex-1 p-8 border-r border-gray-200">
            <div class="grid grid-cols-3 gap-5">

                @foreach ($courses as $course)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col gap-4 cursor-pointer hover:shadow-md transition-shadow">

                    {{-- Card Header --}}
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-base font-bold text-gray-900 leading-snug">{{ $course['title'] }}</h3>
                            <ul class="mt-2 space-y-1">
                                <li class="flex items-center gap-1.5 text-sm text-gray-500">
                                   <x-heroicon-o-document-text class="w-4 h-4 text-gray-400"/>
                                    {{ $course['materials'] }} Material
                                </li>
                                <li class="flex items-center gap-1.5 text-sm text-gray-500">
                                   <x-heroicon-o-clipboard-document-list class="w-4 h-4 text-gray-400"/>
                                    {{ $course['quizzes'] }} Quizzes
                                </li>
                            </ul>
                        </div>
                        {{-- Decorative </> icon --}}
                        <div class="text-gray-200 ml-2 flex-shrink-0">
                           <x-heroicon-o-code-bracket class="w-14 h-14"/>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-1 bg-gray-200 rounded-full h-2.5 overflow-hidden">
                            <div
                                class="bg-blue-400 h-2.5 rounded-full"
                                style="width: {{ $course['progress'] }}%"
                            ></div>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 bg-gray-100 rounded px-1.5 py-0.5 whitespace-nowrap">
                            {{ $course['progress'] }}%
                        </span>
                    </div>

                </div>
                @endforeach

            </div>
        </main>

        {{-- TO-DO SIDEBAR --}}
        <aside class="w-80 bg-white px-6 py-6 flex-shrink-0">

            {{-- Sidebar Header --}}
            <div class="flex items-center gap-2 mb-5">
               <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-orange-400"/>
                <h2 class="text-2xl font-bold text-gray-900">To-do</h2>
            </div>

            <div class="space-y-3 h-screen overflow-y-auto pr-1 drop-shadow-sm">
                @foreach ($todos as $todo)
                <div class="flex items-stretch border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="w-1.5 bg-orange-400 flex-shrink-0 rounded-l-xl"></div>
                    <div class="flex-1 flex items-center justify-between px-4 py-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $todo['title'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">Due : {{ $todo['due'] }}</p>
                        </div>
                        @if ($todo['completed'])
                          <div class="w-6 h-6 rounded bg-green-500 flex items-center justify-center flex-shrink-0 ml-3">
                            <x-heroicon-s-check class="w-4 h-4 text-white"/>
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
