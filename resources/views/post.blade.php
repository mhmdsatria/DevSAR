<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $post->title }} - Berita</title>
</head>

<body>
    <x-header></x-header>
    <x-navbar>puskesmas</x-navbar>

    <x-layout>
        <div class="max-w-screen-xl mx-auto p-4 sm:p-6 md:p-8"> {{-- Adjusted padding for overall layout --}}
            <div class="max-w-screen-lg mx-auto">
                <main class="mt-8"> {{-- Adjusted margin-top --}}

                    <div class="mb-6 md:mb-8 w-full mx-auto relative"> {{-- Adjusted margins --}}
                        <div class="px-0 lg:px-0"> {{-- No horizontal padding here, handled by main x-layout div --}}
                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-gray-800 leading-tight mb-2"> {{-- Adjusted text sizes for responsiveness and added margin-bottom --}}
                                {{ $post->title }}
                            </h2>
                            <p class="py-2 text-green-700 text-sm sm:text-base inline-flex items-center justify-center mb-4"> {{-- Changed from <a> to <p> as it's not a link, adjusted text size and margin --}}
                                Author : {{ $post->author }} |
                                {{ $post->created_at->format('j F Y') }}
                            </p>
                        </div>

                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full object-cover rounded-lg shadow-md" {{-- Added rounded-lg and shadow --}}
                            style="height: 18em; sm:height: 24em; lg:height: 28em;" {{-- Adjusted height for mobile first, then larger screens --}}
                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'"> {{-- Added onerror for fallback image --}}
                    </div>

                    <div class="flex flex-col lg:flex-row lg:space-x-12">
                        <div class="px-0 lg:px-0 mt-8 text-gray-700 text-base sm:text-lg leading-relaxed w-full"> {{-- Adjusted padding and text size for responsiveness --}}
                            <p class="pb-6 text-justify"> {{-- Added text-justify for better readability --}}
                                {{ $post->body }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="/berita" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                            &laquo; Kembali ke Berita
                        </a>
                    </div>
                </main>
            </div>
        </div>
    </x-layout>

    <x-footer :stat="$stat" />
</body>

</html>