{{-- Shared form fields for course create & edit --}}
@php $course = $course ?? null; @endphp

{{-- Reusable input classes --}}
@php
$inputClass = 'w-full px-4 py-2.5 text-sm rounded-xl transition
               bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400
               focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100
               dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:placeholder-slate-500
               dark:focus:border-blue-500 dark:focus:ring-blue-900/30';
$labelClass = 'block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300';
@endphp

<div>
    <label class="{{ $labelClass }}">Course Title <span class="text-red-500">*</span></label>
    <input type="text" name="title" value="{{ old('title', $course?->title) }}" required
           class="{{ $inputClass }}" placeholder="e.g. Dasar Pemrograman">
    @error('title') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label class="{{ $labelClass }}">Description</label>
    <textarea name="description" rows="4"
              class="{{ $inputClass }} resize-none"
              placeholder="Brief description of the course...">{{ old('description', $course?->description) }}</textarea>
    @error('description') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label class="{{ $labelClass }}">Icon Type <span class="text-red-500">*</span></label>
    <select name="icon_type" class="{{ $inputClass }}">
        @foreach(['code' => 'Code / Programming', 'design' => 'Design', 'math' => 'Mathematics', 'science' => 'Science', 'language' => 'Language', 'other' => 'Other'] as $val => $lbl)
            <option value="{{ $val }}" {{ old('icon_type', $course?->icon_type) === $val ? 'selected' : '' }}>
                {{ $lbl }}
            </option>
        @endforeach
    </select>
    @error('icon_type') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
</div>

<div class="flex items-center gap-3 pt-1">
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" value="1" id="is_published"
               class="sr-only peer" {{ old('is_published', $course?->is_published) ? 'checked' : '' }}>
        {{--
            Toggle track:
            light: bg-slate-200 → checked: bg-blue-600
            dark : bg-slate-700 → checked: bg-blue-600 (same — blue reads well on dark)
        --}}
        <div class="w-10 h-6 rounded-full transition-colors
                    bg-slate-200 dark:bg-slate-700
                    peer-checked:bg-blue-600
                    peer-checked:after:translate-x-4
                    after:content-[''] after:absolute after:top-0.5 after:left-0.5
                    after:bg-white after:rounded-full after:w-5 after:h-5 after:transition-transform">
        </div>
    </label>
    <label for="is_published" class="text-sm font-medium cursor-pointer text-slate-700 dark:text-slate-300">
        Publish this course
    </label>
</div>
