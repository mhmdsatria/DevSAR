<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Struktur Organisasi</title> {{-- Changed title to reflect page content --}}
</head>

<body>
    <x-header></x-header>
    <x-navbar>puskesmas</x-navbar>

    {{-- Hero Section for page title and breadcrumbs --}}
    <div class="bg-[#03954A] text-white">
        <div class="p-8 md:p-12 text-white"> {{-- Adjusted padding for responsiveness --}}
            <div class="text-center my-4 md:my-8">
                <h2 class="text-3xl md:text-4xl font-bold">STRUKTUR ORGANISASI</h2> {{-- Adjusted text size for responsiveness --}}
                <nav class="text-sm text-gray-200 mt-2 md:mt-4" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex justify-center items-center space-x-1 sm:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:underline hover:text-white">Home</a>
                            <span class="mx-2 text-gray-300">›</span>
                        </li>
                        <li class="inline-flex items-center text-white font-medium">
                            Struktur Organisasi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <x-layout>
        <section class="py-8 px-4 sm:py-12 sm:px-6 md:py-16 lg:px-8"> {{-- Adjusted padding for responsiveness --}}
            <div class="max-w-4xl mx-auto text-center"> {{-- Centered content, limited max-width --}}
                <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 uppercase mb-6">Bagan Organisasi Puskesmas</h3> {{-- Responsive heading --}}

                {{-- Image of the organizational structure --}}
                <div class="flex justify-center mb-8">
                    @php
                        // Assuming you pass the profile data to this view, or fetch it here
                        $profile = $profile ?? \App\Models\Profile::first();
                    @endphp

                    @if ($profile && $profile->struktur_organisasi)
                        <img src="{{ asset('storage/' . $profile->struktur_organisasi) }}" alt="Struktur Organisasi Puskesmas"
                             class="w-full h-auto object-contain rounded-lg shadow-lg border border-gray-200 max-w-full"> {{-- Responsive image, added max-w-full to ensure it fits, and styling --}}
                    @else
                        <p class="text-gray-500 text-base sm:text-lg">Gambar struktur organisasi belum tersedia.</p> {{-- Responsive text --}}
                    @endif
                </div>

                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                    Struktur organisasi ini menggambarkan hierarki dan hubungan antar unit kerja di Puskesmas kami,
                    bertujuan untuk memastikan pelayanan kesehatan yang efisien dan terkoordinasi.
                </p>
            </div>
        </section>
    </x-layout>

    <x-footer :stat="$stat" />
</body>

</html>