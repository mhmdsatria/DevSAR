<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $post->title ?? 'Berita' }}</title>
</head>

<body class="h-full">

    <x-header></x-header>
    <x-navbar>puskesmas</x-navbar>

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <figure class="mb-4">
                        <img src="{{ asset($post->image ?? 'img/default-thumbnail.jpg') }}" alt="{{ $post->title }}"
                             class="w-full h-auto max-h-[400px] object-cover rounded-lg shadow-md">
                    </figure>

                    <address class="flex items-center mt-4 mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-3 w-12 h-12 sm:w-16 sm:h-16 rounded-full" src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="{{ $post->author }}">
                            <div>
                                <a href="#" rel="author" class="text-base sm:text-xl font-bold text-gray-900 dark:text-white">{{ $post->author }}</a>
                                <p class="text-xs sm:text-base text-gray-500 dark:text-gray-400">{{ $post->slug }}</p>
                                <p class="text-xs sm:text-base text-gray-500 dark:text-gray-400">{{ $post->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </address>

                    <h1 class="mb-4 text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">
                        {{ $post->title }}
                    </h1>
                </header>

                <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                    <p class="lead text-base sm:text-lg">{!! nl2br(e($post->description)) !!}</p>
                    {{-- Asumsi $post->body adalah konten utama berita, tampilkan di sini --}}
                    {{-- Contoh: {!! $post->body !!} --}}
                </div>


                <div class="mt-5 flex flex-wrap gap-2 sm:gap-4">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base">
                        Edit
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base">
                            Hapus
                        </button>
                    </form>
                </div>
            </article>
        </div>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>