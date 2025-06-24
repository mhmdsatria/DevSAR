<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Berita</title>
</head>
<body>
    <x-header></x-header>
    <x-navbar>Puskesmas</x-navbar>

    <div class="bg-[#03954A] text-white">
        <div class="p-8 md:p-12 text-white"> {{-- Reduced padding on small screens --}}
            <div class="text-center my-4 md:my-8">
                <h2 class="text-3xl md:text-4xl font-bold">BERITA TERKINI</h2> {{-- Adjusted text size for responsiveness --}}
                <nav class="text-sm text-gray-200 mt-2 md:mt-4" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex justify-center items-center space-x-1 sm:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:underline hover:text-white">Home</a>
                            <span class="mx-2 text-gray-300">›</span>
                        </li>
                        <li class="inline-flex items-center text-white font-medium">
                            Berita
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <x-layout>
        <div class="max-w-screen-xl mx-auto p-4 sm:p-6 md:p-10"> {{-- Added padding for smaller screens --}}
            {{-- We will only keep pagination at the bottom for cleaner look, unless specifically requested otherwise --}}

            <div class="mt-4 mb-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"> {{-- Added more margin-bottom --}}
                @foreach ($informasi as $post)
                    <a href="/informasi/{{ $post['slug'] }}"
                        class="block bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl hover:-translate-y-1 hover:scale-105 transition duration-300">
                        <img class="w-full h-40 sm:h-48 object-cover" src="{{ asset('storage/' . $post->image) }}" {{-- Adjusted height for responsiveness --}}
                            alt="{{ $post->title }}">

                        <div class="p-4 sm:p-5"> {{-- Adjusted padding for smaller screens --}}
                            <h2 class="text-lg sm:text-xl font-semibold mb-2 text-gray-900">{{ $post['title'] }}</h2> {{-- Adjusted text size and added margin --}}
                            <p class="font-normal text-gray-500 text-sm mb-3">{{ $post['author'] }} |
                                {{ $post->created_at->format('j F Y') }}</p> {{-- Adjusted text size and added margin --}}
                            <p class="text-gray-600 text-sm">{{ Str::words($post['body'], 15, '...') }}</p> {{-- Adjusted text size --}}
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination at the bottom --}}
            <div class="mt-8">
                {{ $informasi->links('pagination::tailwind') }}
            </div>
        </div>
    </x-layout>

    <x-footer :stat="$stat" />
</body>
</html>