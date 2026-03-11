<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz - {{ $quiz->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-poppins">
<div class="min-h-screen bg-gray-100">

    {{-- TOP NAVBAR --}}
    <x-top-navbar />
    {{-- MAIN LAYOUT --}}
    <div class="flex min-h-screen">

        {{-- LEFT: QUESTION AREA --}}
        <main class="flex-1 min-w-0 p-8 border-r border-gray-200">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex flex-col gap-6">

                {{-- Question Header --}}
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Question {{ $currentIndex }}</h2>
                    {{-- Timer --}}
                    <div class="flex items-center gap-0 rounded-xl overflow-hidden border border-blue-500">
                        <div class="bg-blue-500 px-3 py-2 flex items-center">
                            <x-heroicon-s-clock class="w-5 h-5 text-white" />
                        </div>
                        <div class="bg-gray-100 px-4 py-2">
                            <span class="text-base font-bold text-gray-700 tracking-widest" id="timer">
                                {{ $timer ?? '15 : 16' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Question Body --}}
                <div class="bg-white rounded-xl border border-gray-100 px-5 py-4">
                    <p class="text-gray-700 text-base leading-relaxed">{{ $question->body }}</p>
                </div>

                {{-- Answer Options --}}
                <div class="space-y-3">
                    @foreach ($question->options as $index => $option)
                    <label class="flex items-center gap-4 border rounded-xl px-5 py-4 cursor-pointer transition-all
                        {{ $selectedAnswer === $option->id ? 'bg-blue-50 border-blue-400' : 'bg-white border-gray-200 hover:border-gray-300' }}">

                        {{-- Radio --}}
                        <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0
                            {{ $selectedAnswer === $option->id ? 'bg-blue-500 border-2 border-blue-500' : 'border-2 border-gray-300' }}">
                            @if ($selectedAnswer === $option->id)
                                <x-heroicon-s-check class="w-3.5 h-3.5 text-white" />
                            @endif
                        </div>

                        <input type="radio" name="answer" value="{{ $option->id }}"
                            class="hidden"
                            {{ $selectedAnswer === $option->id ? 'checked' : '' }} />

                        <span class="text-sm text-gray-700">{{ $option->body }}</span>
                    </label>
                    @endforeach
                </div>

                {{-- Prev / Next --}}
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('quiz.question', [$quiz->id, $currentIndex - 1]) }}"
                        class="flex items-center gap-2 bg-gray-400 hover:bg-gray-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors
                            {{ $currentIndex <= 1 ? 'opacity-50 pointer-events-none' : '' }}">
                        <x-heroicon-s-chevron-left class="w-4 h-4" />
                        Prev
                    </a>

                    <a href="{{ route('quiz.question', [$quiz->id, $currentIndex + 1]) }}"
                        class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors
                            {{ $currentIndex >= $quiz->questions_count ? 'opacity-50 pointer-events-none' : '' }}">
                        Next
                        <x-heroicon-s-chevron-right class="w-4 h-4" />
                    </a>
                </div>

            </div>
        </main>

        {{-- RIGHT: SIDEBAR --}}
        <aside class="w-80 bg-white flex-shrink-0 px-6 py-6 flex flex-col gap-6">

            {{-- Questions Panel --}}
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Questions</h2>

                {{-- Flag Question --}}
                <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-3 mb-4 cursor-pointer hover:bg-gray-50 transition-colors">
                    <x-heroicon-s-flag class="w-5 h-5 text-red-400" />
                    <span class="text-sm font-semibold text-gray-700">Flag Question</span>
                </div>

                {{-- Question Number Grid --}}
                <div class="grid grid-cols-5 gap-2">
                    @for ($i = 1; $i <= $quiz->questions_count; $i++)
                    <a href="{{ route('quiz.question', [$quiz->id, $i]) }}"
                        class="relative w-10 h-10 flex items-center justify-center rounded-xl text-sm font-semibold transition-colors
                            {{ $i === $currentIndex
                                ? 'bg-blue-500 text-white'
                                : ($answeredQuestions->contains($i)
                                    ? 'bg-white border border-gray-200 text-gray-700'
                                    : 'bg-white border border-gray-200 text-gray-500 hover:bg-gray-50') }}">

                        {{-- Answered indicator (green bar on top) --}}
                        @if ($answeredQuestions->contains($i) && $i !== $currentIndex)
                            <span class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-0.5 w-5 h-1 rounded-full bg-green-400"></span>
                        @endif

                        {{-- Flagged indicator (red triangle) --}}
                        @if ($flaggedQuestions->contains($i))
                            <span class="absolute top-0 right-0 w-0 h-0
                                border-l-[8px] border-l-transparent
                                border-t-[8px] border-t-red-500
                                rounded-tr-xl">
                            </span>
                        @endif

                        {{ $i }}
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Progress Panel --}}
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Progress</h2>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <span>{{ $answeredQuestions->count() }} of {{ $quiz->questions_count }}</span>
                    <span class="text-gray-300">•</span>
                    <span>{{ $flaggedQuestions->count() }} flagged question(s)</span>
                </div>

                {{-- Progress Bar --}}
                <div class="w-full bg-gray-200 rounded-full h-2 mb-5 overflow-hidden">
                    <div class="bg-blue-400 h-2 rounded-full transition-all duration-500"
                        style="width: {{ ($answeredQuestions->count() / $quiz->questions_count) * 100 }}%">
                    </div>
                </div>

                {{-- Submit Button --}}
                <a href="{{ route('quiz.submit', $quiz->id) }}"
                    class="flex items-center justify-center gap-2 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold text-base px-5 py-3 rounded-xl transition-colors">
                    Submit Quiz
                    <x-heroicon-s-chevron-right class="w-5 h-5" />
                </a>
            </div>

        </aside>
    </div>

</div>
</body>
</html>