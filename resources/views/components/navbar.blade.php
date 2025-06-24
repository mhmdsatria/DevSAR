{{-- Make sure Alpine.js and Flowbite are loaded in your main layout if this is a component --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script> --}} {{-- Only include if you're actively using Flowbite components here, otherwise move to main layout --}}

@php
    // Import DB Facade jika belum diimpor di file ini
    use Illuminate\Support\Facades\DB;

    // Ambil data profil utama (nama puskesmas, email)
    $profile = $profile ?? \App\Models\Profile::first();

    // Ambil link sosial media dari tabel social_links
    $socialLinks = $socialLinks ?? DB::table('social_links')->get();

    $daftar_layanan = \App\Models\Pelayanan::all(); // This is here, but not used in the provided navbar section

    // Definisikan platform sosial media dan iconnya
    $iconMap = [
        'facebook' => 'https://img.icons8.com/?size=100&id=118497&format=png&color=000000',
        'instagram' => 'https://img.icons8.com/?size=100&id=Xy10Jcu1L2Su&format=png&color=000000',
        'tiktok' => 'https://img.icons8.com/?size=100&id=118640&format=png&color=000000',
        'youtube' => 'https://img.icons8.com/?size=100&id=youtube-play--v1&format=png&color=000000',
    ];
@endphp

<nav class="sticky top-0 z-50 bg-white shadow-lg shadow-gray-500/50 w-full" x-data="{ open: false }">
    {{-- Top Bar: Email and Social Links --}}
    <div class="bg-white shadow-sm border-b border-gray-200"> {{-- Added subtle border-b for separation --}}
        <div class="flex flex-col sm:flex-row justify-between items-center max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8"> {{-- Added px for smaller screens --}}
            <div class="text-gray-800 text-sm mb-2 sm:mb-0"> {{-- Adjusted margin for mobile --}}
                <span>Email : {{ $profile->email ?? 'email@example.com' }}</span>
            </div>

            <div class="flex space-x-3 sm:space-x-4"> {{-- Adjusted spacing for mobile --}}
                {{-- Loop through socialLinks --}}
                @foreach ($socialLinks as $link)
                    @if (isset($iconMap[$link->platform]))
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" title="{{ ucfirst($link->platform) }}">
                            <img src="{{ $iconMap[$link->platform] }}" alt="{{ ucfirst($link->platform) }}"
                                class="w-6 h-6 sm:w-8 sm:h-8"> {{-- Adjusted icon size for responsiveness --}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- Main Navbar: Puskesmas Name and Navigation Links --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <h1 class="text-gray-800 text-xl sm:text-2xl font-bold truncate"> {{-- Added truncate for long names --}}
                {{ $profile->nama_puskesmas ?? 'Puskesmas Cisaat' }}
            </h1>

            {{-- Mobile Menu Button (Hamburger) --}}
            <div class="block lg:hidden">
                <button @click="open = !open" type="button" class="text-gray-800 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Desktop Navigation Links --}}
            <div class="hidden lg:flex space-x-4">
                <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
                <x-nav-link href="/profil" :active="request()->is('profil')">Profil</x-nav-link>
                <x-nav-link href="/layanan" :active="request()->is('layanan')">Layanan</x-nav-link>
                <x-nav-link href="/dokumentasi" :active="request()->is('dokumentasi')">Dokumentasi</x-nav-link>
                <x-nav-link href="/berita" :active="request()->is('berita')">Berita</x-nav-link>
            </div>
        </div>
    </div>

    {{-- Mobile Menu (Collapsible) --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-full"
         class="lg:hidden bg-white shadow-md border-t border-gray-200 py-2">
        <div class="px-4 pt-2 pb-3 space-y-1 sm:px-6">
            <x-nav-link href="/" :active="request()->is('/')" class="block">Beranda</x-nav-link>
            <x-nav-link href="/profil" :active="request()->is('profil')" class="block">Profil</x-nav-link>
            <x-nav-link href="/layanan" :active="request()->is('layanan')" class="block">Layanan</x-nav-link>
            <x-nav-link href="/dokumentasi" :active="request()->is('dokumentasi')" class="block">Dokumentasi</x-nav-link>
            <x-nav-link href="/berita" :active="request()->is('berita')" class="block">Berita</x-nav-link>
        </div>
    </div>
</nav>