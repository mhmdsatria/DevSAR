<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Dokumentasi</title>
    <style>
        /* Alpine.js Transition Classes */
        .slide-enter-active, .slide-leave-active {
            transition: all 0.5s ease-out; /* Adjusted to ease-out for smoother entry */
        }
        .slide-enter-start {
            opacity: 0;
            transform: translateX(50%); /* Enters from right */
        }
        .slide-enter-end {
            opacity: 1;
            transform: translateX(0);
        }
        .slide-leave-start {
            opacity: 1;
            transform: translateX(0);
        }
        .slide-leave-end {
            opacity: 0;
            transform: translateX(-50%); /* Leaves to left */
        }
    </style>
</head>
<body>
    <x-header></x-header>
    <x-navbar>Puskesmas</x-navbar>

    <div class="bg-[#03954A] text-white">
        <div class="p-8 md:p-12 text-white"> {{-- Reduced padding on small screens --}}
            <div class="text-center my-4 md:my-8">
                <h2 class="text-3xl md:text-4xl font-bold">DOKUMENTASI</h2> {{-- Adjusted text size for responsiveness --}}
                <nav class="text-sm text-gray-200 mt-2 md:mt-4" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex justify-center items-center space-x-1 sm:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:underline hover:text-white">Home</a>
                            <span class="mx-2 text-gray-300">›</span>
                        </li>
                        <li class="inline-flex items-center text-white font-medium">
                            Dokumentasi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <x-layout>
        <div class="max-w-screen-xl mx-auto p-4 sm:p-6 md:p-8"> {{-- Added padding for smaller screens --}}

            <div x-data="{
                open: false,
                images: @js($galleries->pluck('image_path')),
                titles: @js($galleries->pluck('title')),
                index: 0,
                direction: 1, /* 1 for next, -1 for prev */
                get imageSrc() {
                    return '/storage/' + this.images[this.index];
                },
                get imageTitle() {
                    return this.titles[this.index];
                },
                next() {
                    this.direction = 1;
                    if (this.index < this.images.length - 1) this.index++;
                    else this.index = 0;
                },
                prev() {
                    this.direction = -1;
                    if (this.index > 0) this.index--;
                    else this.index = this.images.length - 1;
                },
                openModal(i) {
                    this.index = i;
                    this.open = true;
                    document.body.style.overflow = 'hidden'; /* Prevent scrolling when modal is open */
                }
            }"
            @keydown.window="
                if (open) {
                    if ($event.key === 'ArrowRight') next();
                    if ($event.key === 'ArrowLeft') prev();
                    if ($event.key === 'Escape') {
                        open = false;
                        document.body.style.overflow = ''; /* Restore scrolling */
                    }
                }
            ">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($galleries as $i => $gallery)
                        <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6"> {{-- Adjusted padding for smaller screens --}}
                            <img
                                src="{{ asset('storage/' . $gallery->image_path) }}"
                                alt="{{ $gallery->title }}"
                                class="w-full h-48 sm:h-64 md:h-72 object-cover rounded-lg mb-4 cursor-pointer" {{-- Adjusted height for responsiveness --}}
                                @click="openModal({{ $i }})"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800">{{ $gallery->title }}</h3> {{-- Adjusted text size for responsiveness --}}
                        </div>
                    @endforeach
                </div>

                <div x-show="open"
                    class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-md z-50 p-4" {{-- Added padding to modal for small screens --}}
                    x-transition
                    @keydown.escape.window="open = false; document.body.style.overflow = '';"
                    @click.self="open = false; document.body.style.overflow = '';">

                    <div class="relative max-w-full lg:max-w-3xl w-full text-center"> {{-- Adjusted max-width --}}

                        <div :key="index"
                             x-transition:enter="slide-enter-active slide-enter-start"
                             x-transition:enter-end="slide-enter-end"
                             x-transition:leave="slide-leave-active slide-leave-start"
                             x-transition:leave-end="slide-leave-end">
                            <img :src="imageSrc" :alt="imageTitle" class="rounded-lg max-h-[70vh] sm:max-h-[80vh] w-auto mx-auto object-contain"> {{-- Adjusted max-height and ensured object-contain --}}
                            <h2 class="text-white text-base sm:text-lg mt-2 font-semibold" x-text="imageTitle"></h2> {{-- Adjusted text size for responsiveness --}}
                        </div>

                        <button @click="prev"
                                class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 text-white text-2xl sm:text-3xl px-2 py-1 hover:text-gray-400" aria-label="Previous image"> {{-- Adjusted size and added aria-label --}}
                            &#8592;
                        </button>
                        <button @click="next"
                                class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 text-white text-2xl sm:text-3xl px-2 py-1 hover:text-gray-400" aria-label="Next image"> {{-- Adjusted size and added aria-label --}}
                            &#8594;
                        </button>

                        <button @click="open = false; document.body.style.overflow = '';"
                                class="absolute top-2 right-2 text-white text-3xl p-1 rounded-full bg-black/30 hover:bg-black/50 focus:outline-none" aria-label="Close modal">
                            &times;
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                {{ $galleries->links('pagination::tailwind') }}
            </div>
        </div>
    </x-layout>

    <x-footer :stat="$stat" />

    {{-- Alpine.js is typically loaded in the main layout, but keeping it here if this is a standalone file. --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}
</body>
</html>