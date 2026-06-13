@props(['href', 'active' => false])

@php
    $classes = $active
        ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-indigo-700 bg-indigo-50 transition'
        : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-indigo-700 hover:bg-indigo-50 transition';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
