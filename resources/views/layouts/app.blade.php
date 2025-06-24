<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100 dark:bg-gray-900"> {{-- Tambahkan h-full dan dark mode bg --}}

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>

{{-- Pastikan body memiliki kelas h-full dan flex-col untuk layout yang benar --}}
<body class="h-full font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white flex flex-col min-h-screen">

    {{-- Sticky Navbar --}}
    {{-- Menggunakan x-data="{ open: false }" untuk mengontrol menu mobile --}}
    <nav class="shadow-md sticky top-0 z-50 bg-gradient-to-tr from-lime-500 to-yellow-400" x-data="{ open: false }">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            {{-- Logo / Title --}}
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">Admin Panel</a>

            {{-- Hamburger Menu Button (Hanya terlihat di mobile) --}}
            <div class="md:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Menu Navigasi Desktop (Disembunyikan di mobile) --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('admin.galleries.index') }}"
                    class="px-3 py-2 rounded hover:bg-white hover:bg-opacity-20 transition text-m font-medium text-gray-800">
                    Dokumentasi
                </a>
                <a href="{{ route('admin.posts.index') }}"
                    class="px-3 py-2 rounded hover:bg-white hover:bg-opacity-20 transition text-m font-medium text-gray-800">
                    Berita
                </a>
                <a href="{{ route('admin.pelayanans.index') }}"
                    class="px-3 py-2 rounded hover:bg-white hover:bg-opacity-20 transition text-m font-medium text-gray-800">
                    Layanan
                </a>
                <a href="{{ route('admin.profile.index') }}"
                    class="px-3 py-2 rounded hover:bg-white hover:bg-opacity-20 transition text-m font-medium text-gray-800">
                    Profile
                </a>
                <a href="{{ route('admin.sosmed.index') }}"
                    class="px-3 py-2 rounded hover:bg-white hover:bg-opacity-20 transition text-m font-medium text-gray-800">
                    Sosial Media
                </a>
                <a href="{{ route('admin.carousels.index') }}"
                    class="px-3 py-2 rounded hover:bg-white hover:bg-opacity-20 transition text-m font-medium text-gray-800">
                    Carousel
                </a>
                {{-- Logout Button (Desktop) --}}
                <a href="{{ route('logout') }}"
                    class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-full shadow transition-colors duration-200">
                    Logout
                </a>
            </div>
        </div>

        {{-- Mobile Menu (collapsible with Alpine.js) --}}
        {{-- Menggunakan transisi Alpine.js untuk efek smooth --}}
        <div x-show="open" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="md:hidden px-4 pt-2 pb-3 space-y-1 bg-gradient-to-tr from-lime-600 to-yellow-500 border-t border-gray-700"
            @click.outside="open = false"> {{-- Menutup menu saat klik di luar --}}
            <a href="{{ route('admin.galleries.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-800 hover:bg-white hover:bg-opacity-20 rounded-md">
                Dokumentasi
            </a>
            <a href="{{ route('admin.posts.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-800 hover:bg-white hover:bg-opacity-20 rounded-md">
                Berita
            </a>
            <a href="{{ route('admin.pelayanans.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-800 hover:bg-white hover:bg-opacity-20 rounded-md">
                Layanan
            </a>
            <a href="{{ route('admin.profile.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-800 hover:bg-white hover:bg-opacity-20 rounded-md">
                Profile
            </a>
            <a href="{{ route('admin.sosmed.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-800 hover:bg-white hover:bg-opacity-20 rounded-md">
                Sosial Media
            </a>
            <a href="{{ route('admin.carousels.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-800 hover:bg-white hover:bg-opacity-20 rounded-md">
                Carousel
            </a>
            {{-- Logout Button (Mobile) --}}
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-3 py-2 text-base font-medium text-gray-800 hover:bg-gray-800 hover:text-white rounded-md transition-colors duration-200">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow container mx-auto p-6">
        @yield('content')
    </main>
    <div class="bg-gray-100 dark:bg-gray-950 text-gray-600 dark:text-gray-400 text-center py-4 text-xs md:text-sm">
        <p class="mb-1">&copy; 2025 <span class="font-semibold">SAR Dev.</span></p>
        <p>
            Supported by
            <a href="https://diskominfosan.sukabumikab.go.id" target="_blank"
                class="text-blue-600 hover:underline font-medium">
                DKIP Kabupaten Sukabumi
            </a>
        </p>
    </div>
</body>

</html>