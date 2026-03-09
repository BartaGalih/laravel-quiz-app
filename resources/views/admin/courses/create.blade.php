@extends('admin.layouts.app')
@section('title', 'Create Course')
@section('page-title', 'Create Course')
@section('breadcrumb', 'Add a new course to the platform')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-2xl border overflow-hidden bg-white border-slate-100 dark:bg-slate-900 dark:border-slate-800">
        <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800">
            <h2 class="font-bold text-slate-800 dark:text-slate-100">Course Information</h2>
        </div>
        <form method="POST" action="{{ route('admin.courses.store') }}" class="px-6 py-6 space-y-5">
            @csrf
            @include('admin.courses._form')
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold rounded-xl transition-colors shadow-sm
                               bg-blue-600 hover:bg-blue-700 text-white shadow-blue-200 dark:shadow-blue-900/30">
                    Create Course
                </button>
                <a href="{{ route('admin.courses.index') }}"
                   class="px-6 py-2.5 text-sm font-medium transition-colors text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
