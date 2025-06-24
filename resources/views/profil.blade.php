<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Profil Kami</title>
</head>

<body>
    <x-header />
    <x-navbar />

    {{-- Hero Section for Profil --}}
    <div class="bg-[#03954A] text-white">
        <div class="p-8 md:p-12 text-white"> {{-- Reduced padding on small screens, consistent with other pages --}}
            <div class="text-center my-4 md:my-8"> {{-- Adjusted margins for responsiveness --}}
                <h2 class="text-3xl md:text-4xl font-bold">PROFIL KAMI</h2> {{-- Adjusted text size for responsiveness --}}
                <nav class="text-sm text-gray-200 mt-2 md:mt-4" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex justify-center items-center space-x-1 sm:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:underline hover:text-white">Home</a>
                            <span class="mx-2 text-gray-300">›</span>
                        </li>
                        <li class="inline-flex items-center text-white font-medium">
                            Profil
                        </li>
                         {{-- Removed the empty <li> as it served no purpose --}}
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <x-layout>
        <div class="p-4 sm:p-6 md:p-8 rounded-lg"> {{-- Adjusted padding for smaller screens --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-12"> {{-- Added margin-bottom --}}
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">VISI</h2> {{-- Adjusted text size and added margin --}}
                    <hr class="w-16 border-gray-500 my-2">
                    <p class="text-gray-800 text-base sm:text-lg font-semibold leading-relaxed"> {{-- Adjusted text size and line height --}}
                        "Upaya untuk meningkatkan kualitas pelayanan kesehatan, mendorong kemandirian masyarakat, dan
                        meningkatkan peran serta masyarakat dalam upaya kesehatan."
                    </p>
                </div>
            </div>

            <div class="mt-8 sm:mt-12"> {{-- Adjusted margin-top --}}
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">MISI</h2> {{-- Adjusted text size and added margin --}}
                <hr class="w-16 border-gray-500 my-2">
                <ul class="list-decimal list-inside space-y-2 text-base sm:text-lg text-gray-700"> {{-- Adjusted text size and spacing --}}
                    <li>Memberikan pelayanan kesehatan yang bermutu, adil, dan merata.</li>
                    <li>Meningkatkan kemampuan dan kualitas sumber daya tenaga kesehatan.</li>
                    <li>Meningkatkan tata kelola Puskesmas yang baik, efektif, dan efisien.</li>
                    <li>Mendorong kemandirian masyarakat untuk hidup sehat.</li>
                    <li>Meningkatkan peran serta masyarakat dalam upaya kesehatan baik promotif, preventif, dan kuratif.</li>
                    <li>Mengembangkan kerja sama dengan unsur-unsur terkait di bidang kesehatan.</li>
                </ul>
            </div>
        </div>

        <section class="my-8 sm:my-12 px-4 sm:px-6 lg:px-8"> {{-- Added horizontal padding for smaller screens --}}
            <div class="text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 uppercase mb-2">Struktur Organisasi</h2> {{-- Adjusted text size --}}
                <hr class="w-24 mx-auto border-gray-400 mb-6">
            </div>

            <div class="flex justify-center p-2 sm:p-4"> {{-- Added padding around the image for small screens --}}
                @if ($profile && $profile->struktur_organisasi)
                    <img src="{{ asset('storage/' . $profile->struktur_organisasi) }}" alt="Struktur Organisasi"
                        class="w-full max-w-full h-auto rounded shadow-lg object-contain"> {{-- Changed max-w-3xl to max-w-full and added object-contain for better scaling --}}
                @else
                    <p class="text-gray-500 text-center">Struktur organisasi belum tersedia.</p>
                @endif
            </div>
        </section>
    </x-layout>

    <x-footer :stat="$stat" />
</body>

</html>