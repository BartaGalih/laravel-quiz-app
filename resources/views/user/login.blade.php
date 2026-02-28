<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    @vite('resources/css/app.css')

</head>

<body class="min-h-screen bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">

    <div class="relative w-full max-w-2xl bg-white/70 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">

        <!-- Left: Form -->
        <div class="p-10 md:p-14 flex flex-col justify-center">

            <h1 class="text-4xl font-semibold text-slate-700 text-center mb-4">
                Login
            </h1>

            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Email -->
                <div class="mb-5">
                    <label class="block text-slate-600 mb-2">Email</label>
                    <div
                        class="flex items-center bg-white border border-slate-200 rounded-lg px-4 py-3 focus-within:ring-2 focus-within:ring-blue-400">
                        <svg class="w-5 h-5 text-slate-400 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M16 12H8m8 0l-8-6m8 6l-8 6"></path>
                        </svg>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="example@example.com"
                            class="w-full outline-none bg-transparent text-slate-600 placeholder-slate-400" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="block text-slate-600 mb-2">Password</label>
                    <div
                        class="flex items-center bg-white border border-slate-200 rounded-lg px-4 py-3 focus-within:ring-2 focus-within:ring-blue-400">
                        <svg class="w-5 h-5 text-slate-400 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                            <path d="M5 11h14v8H5z" />
                        </svg>
                        <input type="password" name="password" placeholder="Enter your password"
                            class="w-full outline-none bg-transparent text-slate-600 placeholder-slate-400" required />
                        <svg class="w-5 h-5 text-slate-400 ml-3 cursor-pointer" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                </div>

                <div class="text-right mb-6">
                    <a href="#" class="text-blue-500 text-sm hover:underline">
                        Forgot password?
                    </a>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg shadow-md hover:from-blue-600 hover:to-blue-700 transition">
                    Login
                </button>

            </form>
        </div>

    </div>

</body>

</html>
