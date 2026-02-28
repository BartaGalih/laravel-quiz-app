<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Courses</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <div class="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
    <h1 class="text-3xl font-bold">Courses</h1>
    <div class="flex items-center gap-3">
      <span class="text-lg">Settings</span>
      <div class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full">
        <x-heroicon-s-user-circle class="w-6 h-6 text-gray-600" />
      </div>
    </div>
  </div>

  <div class="flex">

    <!-- Left Content -->
    <div class="w-3/4 p-8">

      <!-- Search & Sort -->
      <div class="flex gap-4 mb-8">
        <div class="flex items-center bg-white px-4 py-2 rounded-lg shadow w-1/2">
          <input type="text" placeholder="Search courses ..." class="w-full outline-none bg-transparent text-sm" />
        </div>
        <div class="bg-white px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
          <span>Sort by :</span>
          <select class="outline-none bg-transparent font-medium">
            <option>Progress</option>
          </select>
        </div>
      </div>

      <!-- Course Grid -->
      <div class="grid grid-cols-3 gap-6">

        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-5 relative">
          <h2 class="font-semibold text-lg">Dasar Permrograman</h2>
          <p class="text-sm text-gray-500 mt-1">1 Material</p>
          <p class="text-sm text-gray-500">2 Quizzes</p>

          <div class="mt-6">
            <div class="w-full bg-gray-200 h-2 rounded-full">
              <div class="bg-blue-500 h-2 rounded-full w-[90%]"></div>
            </div>
            <div class="absolute bottom-4 right-4 text-xs bg-gray-200 px-2 py-1 rounded-full">
              90%
            </div>
          </div>
        </div>

        <!-- Duplicate cards -->
        <div class="bg-white rounded-xl shadow p-5 relative">
          <h2 class="font-semibold text-lg">Dasar Permrograman</h2>
          <p class="text-sm text-gray-500 mt-1">1 Material</p>
          <p class="text-sm text-gray-500">2 Quizzes</p>
          <div class="mt-6">
            <div class="w-full bg-gray-200 h-2 rounded-full">
              <div class="bg-blue-500 h-2 rounded-full w-[90%]"></div>
            </div>
            <div class="absolute bottom-4 right-4 text-xs bg-gray-200 px-2 py-1 rounded-full">
              90%
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow p-5 relative">
          <h2 class="font-semibold text-lg">Algoritma</h2>
          <p class="text-sm text-gray-500 mt-1">1 Material</p>
          <p class="text-sm text-gray-500">2 Quizzes</p>
          <div class="mt-6">
            <div class="w-full bg-gray-200 h-2 rounded-full">
              <div class="bg-blue-500 h-2 rounded-full w-[90%]"></div>
            </div>
            <div class="absolute bottom-4 right-4 text-xs bg-gray-200 px-2 py-1 rounded-full">
              90%
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Right Sidebar -->
    <div class="w-1/4 bg-gray-50 drop-shadow-xl p-6 h-screen">
      <h2 class="text-xl font-semibold mb-6">To-do</h2>

      <!-- Todo Item -->
      <div class="bg-white rounded-xl shadow p-4 mb-4 border-l-4 border-red-400">
        <div class="flex justify-between items-center">
          <h3 class="font-medium">Algoritma - Quiz 1</h3>
          <span class="text-green-600 font-bold">✔</span>
        </div>
        <p class="text-sm text-gray-500 mt-1">Due : Fri, 21 Jan, 12:00 PM</p>
      </div>
    </div> 
  </div>

</body>
</html>