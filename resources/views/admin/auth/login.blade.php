<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Quiz App</title>
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
</head>
<body class="bg-blue-50 font-sans antialiased">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl shadow-blue-100 overflow-hidden border border-blue-100">
            <div class="p-10">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>

                <h2 class="text-3xl font-extrabold text-blue-900 text-center tracking-tight">Welcome Back!</h2>
                <p class="text-blue-400 text-center mt-2 mb-10">Admin Quiz App</p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl bg-blue-50 border border-transparent focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition duration-300 outline-none" 
                            placeholder="admin@quiz.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl bg-blue-50 border border-transparent focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition duration-300 outline-none" 
                            placeholder="********">
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-blue-700">Remember me</span>
                        </label>
                        <a href="#" class="font-semibold text-blue-600 hover:text-blue-800 transition">Forgot Password?</a>
                    </div>

                    <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 transform hover:-translate-y-0.5 transition duration-300">
                        Sign In
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-blue-50 text-center text-sm text-gray-500">
                    Not an admin? <a href="/login" class="text-blue-600 font-bold hover:underline">User Login</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>