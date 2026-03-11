    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
       
        @if (Route::currentRouteName() === 'dashboard')
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Courses</h1>
        @else
            <nav class="flex items-center gap-2 text-base">
                @foreach ($breadcrumbs as $index => $crumb)
                    @if ($index < count($breadcrumbs) - 1)
                        <a href="{{ $crumb['url'] }}" class="text-gray-400 hover:text-gray-600 transition-colors">{{ $crumb['label'] }}</a>
                        <x-heroicon-o-chevron-right class="w-4 h-4 text-gray-400" />
                    @else
                        <span class="font-bold text-gray-900">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <div class="flex items-center gap-2 text-gray-700">
            <span class="text-xl font-semibold">Settings</span>
            <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center">
                <x-heroicon-s-cog-6-tooth class="w-5 h-5 text-gray-700" />
            </div>
        </div>
    </header>