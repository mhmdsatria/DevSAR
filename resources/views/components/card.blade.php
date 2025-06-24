@props(['title', 'description', 'link'])

<a href="{{ $link }}" class="block rounded-xl bg-white p-5 sm:p-6 shadow-xl text-left hover:shadow-2xl hover:-translate-y-1 transition duration-300"> {{-- Slightly reduced padding for mobile, added -translate-y-1 on hover --}}
    <h5 class="text-gray-900 mb-2 text-lg sm:text-xl font-medium leading-tight"> {{-- Changed to gray-900, adjusted text size, and added leading-tight --}}
        {{ $title }}
    </h5>
    <p class="mb-1 font-normal text-gray-500 text-sm sm:text-base"> {{-- Adjusted text size for responsiveness --}}
        {{ Str::words($description, 15, '...')}}
    </p>
</a>