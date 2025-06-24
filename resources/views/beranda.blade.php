<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        /* Tetap mempertahankan gaya carousel */
        [data-carousel-item] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            display: none;
            transition: opacity 0.7s ease-in-out;
        }

        [data-carousel-item].active {
            opacity: 1;
            visibility: visible;
            display: block;
        }

        /* Untuk bagian dropdown agar ada di tengah (tetap) */
        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Grid untuk menyusun grafik berdampingan (disesuaikan untuk responsif) */
        .chart-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px; /* Kurangi gap untuk mobile */
            flex-wrap: wrap;
            margin-top: 20px;
        }

        /* Ukuran grafik agar seimbang (disesuaikan untuk responsif) */
        .chart-container {
            width: 90%; /* Lebar penuh di mobile */
            max-width: 500px; /* Batasan maksimum */
            height: 300px; /* Sesuaikan tinggi agar tidak terlalu besar di mobile */
        }

        @media (min-width: 768px) {
            .chart-container {
                width: 45%; /* Kembali ke 45% di desktop */
                height: 400px; /* Kembali ke tinggi semula di desktop */
            }
        }

        /* Menyesuaikan ukuran canvas */
        canvas {
            width: 100% !important;
            height: 100% !important; /* Biarkan tinggi menyesuaikan container */
        }
    </style>
    <title>Beranda</title>
</head>

<body>
    <x-header></x-header>
    <x-navbar>puskesmas</x-navbar>
    <div x-data="{ active: 0 }" x-init="setInterval(() => active = (active + 1) % {{ count($carousels) }}, 10000)" class="relative w-full overflow-hidden shadow-lg">
        <div class="relative w-full h-80 sm:h-96 lg:h-120 object-cover">
            @foreach ($carousels as $index => $carousel)
                <div class="absolute inset-0 transition-opacity duration-700" x-show="active === {{ $index }}"
                    x-transition:enter="transition-opacity ease-in-out duration-2000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-in-out duration-2000"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <img src="{{ asset('storage/' . $carousel->image) }}" alt="Carousel {{ $index + 1 }}"
                        class="object-cover w-full h-full">
                </div>
            @endforeach
        </div>

        <div class="absolute inset-0 flex items-center justify-between px-4">
            <button @click="active = active === 0 ? {{ count($carousels) }} - 1 : active - 1"
                class="bg-black/50 hover:bg-black/70 text-white rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="active = (active + 1) % {{ count($carousels) }}"
                class="bg-black/50 hover:bg-black/70 text-white rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </svg>
            </button>
        </div>

        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            @foreach ($carousels as $index => $carousel)
                <button @click="active = {{ $index }}"
                    :class="{ 'bg-white': active === {{ $index }}, 'bg-white/50': active !== {{ $index }} }"
                    class="w-3 h-3 rounded-full"></button>
            @endforeach
        </div>

    </div>


    <div class="bg-gray-100">
        <x-layout>
            <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
                <div class="mb-5 flex justify-center text-sm">
                    <div class="text-center my-8">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">LAYANAN KAMI</h2>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($pelayanans as $pelayanan)
                        <a href="{{ url('/layanan/' . $pelayanan->id) }}" class="block">
                            <article
                                class="bg-[#03954A] text-white rounded-lg shadow-md hover:shadow-xl transition flex items-center justify-center h-32">
                                <h2 class="text-xl font-semibold text-center px-4">
                                    {{ $pelayanan->title }}
                                </h2>
                            </article>
                        </a>
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="/layanan"
                        class="inline-block px-6 py-3 mt-4 text-[#03954A] bg-white border border-[#03954A] rounded-lg shadow-lg
           transition duration-300 ease-in-out hover:bg-[#03954A] hover:text-white">
                        Lihat Semua Layanan
                    </a>

                </div>
            </div>
        </x-layout>
    </div>


    <x-layout>
        <div class="max-w-6xl mx-auto px-4 py-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                {{-- Kolom Teks --}}
                <div class="md:w-1/2 text-center md:text-left">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-gray-800">Pendaftaran Online</h1>
                    <p class="text-base sm:text-lg text-gray-800">
                        Sekarang pendaftaran untuk layanan kesehatan bisa dilakukan secara online dengan mudah dan
                        cepat.
                        Silahkan mengunduh dan membuat akun untuk salah satu aplikasi ini.
                    </p>
                </div>

                {{-- Kolom Logo --}}
                <div class="md:w-1/2 flex justify-center md:justify-end gap-x-6 sm:gap-x-10 mt-6 md:mt-0">
                    <img src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="Logo 1" class="h-14 sm:h-16 md:h-20">
                    {{--  <img src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="Logo 2" class="h-14 sm:h-16 md:h-20">
                    <img src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="Logo 3" class="h-14 sm:h-16 md:h-20">  --}}
                </div>

            </div>
        </div>
    </x-layout>
    <div class="bg-gray-100">
        <x-layout class="">
            <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
                <div class="mb-5 flex justify-center text-sm">
                    <div class="text-center my-8">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">BERITA TERKINI</h2>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($beranda as $post)
                        <a href="/informasi/{{ $post->slug }}" class="block group">
                            <article
                                class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $post->image) }}"
                                    alt="{{ $post->title }}">
                                <div class="p-5">
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        {{ $post->title }}
                                    </h2>
                                    <p class="font-base text-gray-500">{{ $post->author }} |
                                        {{ $post->created_at->format('d M Y') }}</p>
                                    <p class="text-gray-600 mt-2">
                                        {{ \Illuminate\Support\Str::words(strip_tags($post->body), 15, '...') }}
                                    </p>
                                    <span
                                        class="inline-block mt-4 text-gray-600 group-hover:text-blue-600 group-hover:underline transition">
                                        Baca Selengkapnya
                                    </span>
                                </div>
                            </article>
                        </a>
                    @endforeach

                </div>
                <div class="text-center mt-8">
                    <a href="/berita" :active="request() - > is('berita')"
                        class="inline-block px-6 py-3 mt-4 text-[#03954A] bg-white border border-[#03954A] rounded-lg shadow-lg
           transition duration-300 ease-in-out hover:bg-[#03954A] hover:text-white">
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </x-layout>
    </div>

    <x-layout>
        <div x-data="statistikData()" x-init="init()">
            <div class="header flex flex-col items-center justify-center gap-4 mb-6">
                <div class="text-center my-8">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">STATISTIK KUNJUNGAN</h2>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-2">
                    <label class="font-semibold">Pilih Periode:</label>
                    <select x-model="selectedPeriod" @change="updateChart()" class="p-2 border rounded w-full sm:w-auto">
                        <option value="Harian">Harian</option>
                        <option value="Mingguan">Mingguan</option>
                        <option value="Bulanan">Bulanan</option>
                    </select>
                </div>
            </div>

            <div class="chart-wrapper flex flex-wrap justify-center gap-6 sm:gap-10">
                <div class="chart-container w-full max-w-sm sm:max-w-md">
                    <h3 class="text-center font-semibold mb-2">Cara Bayar</h3>
                    <canvas id="kunjunganChart"></canvas>
                </div>

                <div class="chart-container w-full max-w-sm sm:max-w-md">
                    <h3 class="text-center font-semibold mb-2">Jenis Kelamin</h3>
                    <canvas id="genderChart"></canvas>
                </div>
            </div>

            <div class="flex justify-center mt-10 px-4">
                <div class="chart-container w-full max-w-2xl lg:max-w-4xl">
                    <h3 class="text-center font-semibold mb-4">10 Penyakit Terbesar</h3>
                    <canvas id="penyakitChart"></canvas>
                </div>
            </div>
        </div>

        <script>
            function statistikData() {
                return {
                    selectedPeriod: 'Harian',
                    kunjunganChart: null,
                    genderChart: null,
                    penyakitChart: null,

                    kunjunganData: {
                        "Harian": [50, 30, 20, 15, 10], // Tunai, BPJS, SKTM, Asuransi, Gratis
                        "Mingguan": [300, 200, 150, 120, 80],
                        "Bulanan": [1200, 800, 600, 500, 400]
                    },

                    genderData: {
                        labels: ["Laki-laki", "Perempuan"],
                        values: [60, 40]
                    },

                    penyakitData: {
                        labels: ["Flu", "Demam", "Batuk", "Asma", "TBC", "Hipertensi", "Diabetes", "COVID-19", "Diare", "Maag"],
                        values: [500, 450, 400, 380, 350, 320, 300, 290, 280, 270]
                    },

                    init() {
                        // Pie Chart Cara Bayar
                        const ctx1 = document.getElementById('kunjunganChart').getContext('2d');
                        this.kunjunganChart = new Chart(ctx1, {
                            type: 'doughnut',
                            data: {
                                labels: ["Tunai", "BPJS", "SKTM", "Asuransi", "Gratis"],
                                datasets: [{
                                    data: this.kunjunganData[this.selectedPeriod],
                                    backgroundColor: ["#4CAF50", "#FF9800", "#2196F3", "#9C27B0", "#F44336"]
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });

                        // Pie Chart Jenis Kelamin
                        const ctx2 = document.getElementById('genderChart').getContext('2d');
                        this.genderChart = new Chart(ctx2, {
                            type: 'doughnut',
                            data: {
                                labels: this.genderData.labels,
                                datasets: [{
                                    data: this.genderData.values,
                                    backgroundColor: ["#1E90FF", "#FF69B4"]
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });

                        // Bar Chart Penyakit
                        const ctx3 = document.getElementById('penyakitChart').getContext('2d');
                        this.penyakitChart = new Chart(ctx3, {
                            type: 'bar',
                            data: {
                                labels: this.penyakitData.labels,
                                datasets: [{
                                    label: 'Jumlah Pasien',
                                    data: this.penyakitData.values,
                                    backgroundColor: "#3b82f6"
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        ticks: {
                                            autoSkip: true,
                                            maxRotation: 45,
                                            minRotation: 0,
                                        }
                                    }
                                }
                            }
                        });
                    },

                    updateChart() {
                        this.kunjunganChart.data.datasets[0].data = this.kunjunganData[this.selectedPeriod];
                        this.kunjunganChart.update();
                    }
                };
            }
        </script>
    </x-layout>
    <div class="m-8">
        <h1></h1>
    </div>

    <x-footer :stat="$stat" />

</body>

</html>