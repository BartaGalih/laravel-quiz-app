@extends('admin.layouts.app')
@section('title', 'Users')
@section('page-title', 'Users')
@section('breadcrumb', 'Manage registered users')

@section('content')

@php
$inputClass = 'text-sm rounded-xl transition focus:outline-none
               bg-slate-50 border border-slate-200 text-slate-700 placeholder-slate-400
               focus:border-blue-400 focus:ring-2 focus:ring-blue-100
               dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:placeholder-slate-500
               dark:focus:border-blue-500 dark:focus:ring-blue-900/30';
@endphp

<div class="rounded-2xl border mb-4 px-5 py-4 flex flex-wrap items-center gap-3
            bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <form method="GET" class="flex-1 flex items-center gap-3 min-w-0">
        <div class="relative flex-1 max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 dark:text-slate-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..."
                   class="{{ $inputClass }} w-full pl-9 pr-4 py-2.5">
        </div>
        <button type="submit" class="px-4 py-2.5 text-sm font-semibold rounded-xl transition bg-blue-600 hover:bg-blue-700 text-white">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.users.index') }}" class="text-sm transition text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300">Clear</a>
        @endif
    </form>
    <p class="text-sm text-slate-400 dark:text-slate-500">{{ $users->total() }} users</p>
</div>

<div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">User</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Courses Enrolled</th>
                <th class="text-center px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Quiz Attempts</th>
                <th class="text-left px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Joined</th>
                <th class="text-right px-6 py-3.5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
            @forelse ($users as $user)
                <tr class="transition-colors group hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 bg-blue-100 dark:bg-blue-900/40">
                                <span class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800 dark:text-slate-100">{{ $user->name }}</p>
                                <p class="text-xs text-slate-400 dark:text-slate-500">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $user->enrollments_count }}</td>
                    <td class="px-4 py-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ $user->quiz_attempts_count }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500 dark:text-slate-400">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.users.show', $user) }}"
                               class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:text-slate-600 dark:hover:text-blue-400 dark:hover:bg-blue-900/30" title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Delete user {{ addslashes($user->name) }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg transition-colors text-slate-400 hover:text-red-600 hover:bg-red-50 dark:text-slate-600 dark:hover:text-red-400 dark:hover:bg-red-900/30" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-sm text-slate-400 dark:text-slate-600">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-50 dark:border-slate-800">{{ $users->links() }}</div>
    @endif
</div>

@endsection
