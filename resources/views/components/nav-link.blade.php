@props(['active', 'class' => '']) {{-- Added 'class' prop to merge custom classes --}}

@php
$baseClasses = 'rounded-md px-3 py-2 text-base font-medium'; // Changed 'text-m' to 'text-base' for standard Tailwind size
$activeClasses = 'text-blue-700 bg-blue-50'; // More distinct active state
$inactiveClasses = 'text-gray-800 hover:text-blue-500 hover:bg-gray-100'; // Added hover background

$classes = ($active ?? false)
            ? $activeClasses
            : $inactiveClasses;

// Merge base classes with active/inactive classes and any additional classes passed
$combinedClasses = trim("{$baseClasses} {$classes} {$class}");
@endphp

<a {{ $attributes->merge(['class' => $combinedClasses]) }}>
    {{ $slot }}
</a>