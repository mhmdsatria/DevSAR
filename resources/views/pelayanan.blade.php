<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Layanan</title>
</head>

<body>
    <x-header></x-header>
    <x-navbar>puskesmas</x-navbar>

    {{-- Hero Section for Layanan --}}
    <div class="bg-[#03954A] text-white">
        <div class="p-8 md:p-12 text-white"> {{-- Reduced padding on small screens, consistent with other pages --}}
            <div class="text-center my-4 md:my-8"> {{-- Adjusted margins for responsiveness --}}
                <h2 class="text-3xl md:text-4xl font-bold">LAYANAN KAMI</h2> {{-- Adjusted text size for responsiveness --}}
                <nav class="text-sm text-gray-200 mt-2 md:mt-4" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex justify-center items-center space-x-1 sm:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:underline hover:text-white">Home</a>
                            <span class="mx-2 text-gray-300">›</span>
                        </li>
                        <li class="inline-flex items-center text-white font-medium">
                            Layanan
                        </li>
                         {{-- Removed the empty <li> as it served no purpose --}}
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <x-layout>
        <div class="max-w-screen-xl mx-auto p-4 sm:p-6 md:p-8"> {{-- Added initial padding for smaller screens --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($pelayanans as $pelayanan)
                    <x-card
                        title="{{ $pelayanan->title }}"
                        link="{{ url('/layanan/' . $pelayanan->id) }}"
                        description="{{ $pelayanan->description }}">
                    </x-card>
                @endforeach
            </div>
        </div>
    </x-layout>

    <x-footer :stat="$stat" />
</body>

</html>