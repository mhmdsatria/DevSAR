<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Detail Pelayanan</title>
</head>

<body class="bg-gray-50 text-gray-800">
    <x-header></x-header>
    <x-navbar>puskesmas</x-navbar>
    <div class="bg-[#03954A] p-8 sm:p-12 text-white">
        <div class="text-center my-4 sm:my-8">
            <h2 class="text-3xl sm:text-4xl font-bold">{{ $pelayanan->title }}</h2>

            <nav class="text-xs sm:text-sm text-gray-200 mt-2 sm:mt-4" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex justify-center items-center space-x-0.5 sm:space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="/" class="hover:underline hover:text-white">Home</a>
                        <span class="mx-1 sm:mx-2 text-gray-300">›</span>
                    </li>
                    <li class="inline-flex items-center">
                        <a href="/layanan" class="hover:underline hover:text-white">Layanan Kami</a>
                        <span class="mx-1 sm:mx-2 text-gray-300">›</span>
                    </li>
                    <li class="inline-flex items-center text-white font-medium">
                        {{ $pelayanan->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <x-layout>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
            {{-- Judul Utama --}}
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2 sm:mb-3">{{ $pelayanan->title }}</h1>
            {{-- Hari Layanan --}}
            <div class="text-sm text-gray-600 mb-3 sm:mb-4">
                <strong>Hari Layanan:</strong> {{ $pelayanan->days }}
            </div>

            {{-- Detail Layanan --}}
            @if ($details->count())
                <div class="grid gap-4 mt-3 sm:mt-4">
                    @foreach ($details as $detail)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-5">
                            <p class="text-sm sm:text-base text-gray-700">{{ $detail->detail }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Informasi Utama --}}
            <div
                class="bg-white rounded-xl shadow-md p-5 sm:p-6 md:p-8 border border-gray-200 leading-relaxed text-gray-700 space-y-4 mt-6 sm:mt-8">
                <p class="text-sm sm:text-base">{!! nl2br(e($pelayanan->description)) !!}</p>
            </div>

            {{-- Detail Tambahan (Jika ada, atau dihapus jika duplikat dari bagian atas) --}}
            {{-- Jika Anda ingin menampilkan detail tambahan ini secara terpisah, pastikan ini bukan duplikat.
                 Jika $details sudah ditampilkan di atas, bagian ini bisa dihapus atau disesuaikan untuk konten yang berbeda. --}}
            {{-- @if ($details->count())
                <div class="grid gap-4 mt-6 sm:mt-8">
                    @foreach ($details as $detail)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-5">
                            <p class="text-sm sm:text-base text-gray-700">{{ $detail->detail }}</p>
                        </div>
                    @endforeach
                </div>
            @endif --}}

            {{-- Tombol Kembali --}}
            <div class="mt-8 sm:mt-10">
                <a href="{{ url('/layanan') }}"
                    class="inline-block text-indigo-600 hover:text-indigo-800 font-medium transition-all duration-200 text-sm sm:text-base">
                    &larr; Kembali ke Daftar Pelayanan
                </a>
            </div>
        </div>
    </x-layout>

    <x-footer :stat="$stat" />
</body>

</html>