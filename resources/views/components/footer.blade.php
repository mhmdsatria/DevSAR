@props(['stat' => null, 'profile' => null])
@php
    // Fetch profile if not provided, assuming it's the latest
$profile = $profile ?? \App\Models\Profile::latest()->first();

// Fallback if profile is still null (e.g., no profiles in DB)
if (!$profile) {
    $profile = (object) [
        'nama_puskesmas' => 'Puskesmas Cisaat',
        'alamat' => 'Alamat belum tersedia',
        'email' => 'email@example.com',
        ];
    }
@endphp

<footer class="text-white text-sm" style="background: linear-gradient(to bottom, #FFD707, #03954A);">
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        {{-- Logo Lembaga --}}
        <div class="flex flex-wrap justify-center gap-x-4 gap-y-6 mb-6">
            <div class="flex flex-col items-center w-24 sm:w-28 text-center">
                <a href="https://www.kemkes.go.id" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center">
                    <img src="{{ asset('img/logo-kemenkes.png') }}" alt="Kementerian Kesehatan"
                        class="h-14 md:h-16 mb-2 object-contain">
                    <p class="text-xs text-white leading-tight hover:underline text-center">
                        Kementerian Kesehatan<br>Republik Indonesia
                    </p>
                </a>
            </div>

            <div class="flex flex-col items-center w-24 sm:w-28 text-center">
                <a href="https://sukabumikab.go.id" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center">
                    <img src="{{ asset('img/Lambang_Kab_Sukabumi.svg') }}" alt="Kabupaten Sukabumi"
                        class="h-14 md:h-16 mb-2 object-contain">
                    <p class="text-xs text-white leading-tight hover:underline text-center">
                        Pemerintah Kabupaten<br>Sukabumi
                    </p>
                </a>
            </div>
            <div class="flex flex-col items-center w-24 sm:w-28 text-center">
                <a href="https://dinkes.sukabumikab.go.id" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center">
                    <img src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="Dinas Kesehatan"
                        class="h-14 md:h-16 mb-2 object-contain">
                    <p class="text-xs text-white leading-tight hover:underline text-center">
                        Dinas Kesehatan Kabupaten Sukabumi
                    </p>
                </a>
            </div>
        </div>

        {{-- Garis Pemisah --}}
        <div class="border-t border-white/50 mb-6"></div>

        {{-- Baris Bawah: Alamat/Email and Statistik/Copyright --}}
        <div class="flex flex-col md:flex-row justify-between items-start text-white gap-6 md:gap-x-8">
            {{-- Alamat dan Email --}}
            <div class="text-center md:text-left mb-4 md:mb-0">
                <strong class="block text-base mb-1">{{ $profile->nama_puskesmas }}</strong>
                <span class="block mb-1">Alamat : {{ $profile->alamat }}</span>
                <span class="block">Surel : {{ $profile->email }}</span>
            </div>

            {{-- Statistik & Copyright --}}
            <div class="w-full md:w-auto text-center md:text-right">
    @if (isset($stat))
        <p class="text-sm md:text-base text-white mb-2">
            Pengunjung hari ini : {{ $stat['today'] ?? 0 }}<br class="sm:hidden">|
            Kemarin : {{ $stat['yesterday'] ?? 0 }}<br class="sm:hidden">|
            Minggu ini : {{ $stat['this_week'] ?? 0 }}<br class="sm:hidden">|
            Bulan ini : {{ $stat['this_month'] ?? 0 }}<br class="sm:hidden">|
            Tahun ini : {{ $stat['this_year'] ?? 0 }}<br class="sm:hidden">|
        </p>
    @else
        {{-- Opsional: Tampilkan pesan error atau placeholder jika $stat tidak tersedia --}}
        <p class="text-sm md:text-base text-white mb-2">Statistik pengunjung tidak tersedia.</p>
    @endif
</div>
        </div>
    </div>
</footer>

{{-- Footer Bawah (Copyright & Supported by) --}}
<div class="bg-gray-100 text-gray-600 text-center py-4 text-xs md:text-sm rounded-t-xl">
    <p class="mb-1">&copy; {{ date('Y') }} <span class="font-semibold">SAR Dev.</span></p>
    <p>
        Supported by
        <a href="https://diskominfosan.sukabumikab.go.id" target="_blank" rel="noopener noreferrer"
            class="text-blue-600 hover:underline font-medium">
            DKIP Kabupaten Sukabumi
        </a>
    </p>
</div>
