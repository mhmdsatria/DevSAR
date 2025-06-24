<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100 dark:bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gallery->title }} - Dokumentasi</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-900 flex flex-col min-h-screen">

    <x-header></x-header>

    <x-navbar>Dokumentasi</x-navbar>

    <main class="flex-grow container mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-gray-800 dark:text-white">
            {{ $gallery->title }}
        </h1>

        <div class="max-w-2xl mx-auto rounded-lg overflow-hidden shadow-lg bg-white dark:bg-gray-800">
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ asset('storage/' . $gallery->image_path) }}"
                    alt="{{ $gallery->title }}"
                    class="w-full h-full object-contain sm:object-cover" {{-- Use object-contain to ensure image fits without cropping on smaller screens --}}
                    onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"> {{-- Handle broken image more robustly --}}
            </div>

            <div class="p-4 sm:p-6">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white mb-2">
                    {{ $gallery->title }}
                </h3>
                <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $gallery->description ?? 'Deskripsi belum tersedia.' }}
                </p>
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    <p>Dipublikasikan pada: {{ $gallery->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('galleries.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-800 dark:focus:ring-offset-gray-900">
                &larr; Kembali ke Daftar Dokumentasi
            </a>
        </div>
    </main>

    <x-footer></x-footer>

</body>
</html>