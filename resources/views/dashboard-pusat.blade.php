<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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

        /* Untuk bagian dropdown agar ada di tengah */
        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Grid untuk menyusun grafik berdampingan */
        .chart-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        /* Ukuran grafik agar seimbang */
        .chart-container {
            width: 45%;
            max-width: 500px;
            height: 400px;
            /* Pastikan tinggi cukup */
        }


        /* Menyesuaikan ukuran canvas */
        canvas {
            width: 100% !important;
            height: 300px !important;
        }
    </style>
    <title>Beranda</title>
</head>

<x-header></x-header>
<body class="bg-gray-50 font-sans antialiased">
    <div class="mb-6 bg-white p-4 rounded shadow">

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <h2 class="text-xl font-semibold mb-2">Tambah Wilayah Baru</h2>
    <form action="{{ route('dashboard.pusat.wilayah.store') }}" method="POST" class="mb-6">
        @csrf
        <input type="text" name="nama" placeholder="Nama Wilayah" class="border p-2 rounded w-full" required>
        <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Wilayah</button>
    </form>

    <h2 class="text-xl font-semibold mb-2">Tambah Puskesmas Baru</h2>
    <form action="{{ route('dashboard.pusat.puskesmas.store') }}" method="POST" class="space-y-3">
        @csrf

        <select name="wilayah_id" required class="border p-2 rounded w-full">
            <option value="">-- Pilih Wilayah --</option>
            @foreach ($wilayahs as $wilayah)
                <option value="{{ $wilayah->id }}">{{ $wilayah->nama }}</option>
            @endforeach
        </select>

        <input type="text" name="nama" placeholder="Nama Puskesmas" class="border p-2 rounded w-full" required>
        <input type="text" name="alamat" placeholder="Alamat Puskesmas" class="border p-2 rounded w-full" required>
        <input type="text" name="latitude" placeholder="Latitude (misal: -7.1234567)" class="border p-2 rounded w-full">
        <input type="text" name="longitude" placeholder="Longitude (misal: 107.123456)" class="border p-2 rounded w-full">
        <input type="url" name="api_url" placeholder="URL API (misal: https://puskesmas-a.domain/api)" class="border p-2 rounded w-full" required>
        <input type="text" name="api_token" placeholder="API Token" class="border p-2 rounded w-full" required>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Puskesmas</button>
    </form>

</div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-center mb-8 text-gray-800"></h1>
    
        <!-- Wilayah & Peta -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Wilayah -->
            <div class="md:col-span-1 bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Wilayah Layanan</h2>
                <ul class="space-y-2">
                    @foreach ($wilayahs as $wilayah)
                        <li>
                            <button
                                class="w-full text-left px-4 py-2 rounded-md bg-gray-100 hover:bg-blue-100 text-gray-700 transition font-medium"
                                onclick="loadPuskesmas({{ $wilayah->id }})">
                                {{ $wilayah->nama }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
    
            <!-- Peta -->
            <div class="md:col-span-2 bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Peta Lokasi Puskesmas</h2>
                <div id="mapid" class="h-96 w-full rounded-md">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    
        <!-- Detail Puskesmas -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Detail Puskesmas</h2>
            <div id="puskesmas-details" class="text-gray-700 space-y-3">
                <p class="italic text-gray-500">Pilih puskesmas dari peta atau daftar wilayah di atas.</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 text-gray-600 text-center py-4 text-xs md:text-sm">
        <p class="mb-1">&copy; 2025 <span class="font-semibold">SAR Dev.</span></p>
        <p>
            Supported by
            <a href="https://diskominfosan.sukabumikab.go.id" target="_blank"
                class="text-blue-600 hover:underline font-medium">
                DKIP Kabupaten Sukabumi
            </a>
        </p>
    </div>
    
    
    <!-- Script --> 
    <script>
        var map = L.map('mapid').setView([-7.0000, 107.0000], 10);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    
        let puskesmasMarkers = [];
    
        async function loadPuskesmas(wilayahId) {
            const response = await fetch(`/wilayah/${wilayahId}/puskesmas`);
            const data = await response.json();
            updateMapMarkers(data);
        }
    
        function updateMapMarkers(puskesmasList) {
            puskesmasMarkers.forEach(marker => map.removeLayer(marker));
            puskesmasMarkers = [];
    
            puskesmasList.forEach(puskesmas => {
                if (puskesmas.latitude && puskesmas.longitude) {
                    const marker = L.marker([puskesmas.latitude, puskesmas.longitude])
                        .addTo(map)
                        .bindPopup(puskesmas.nama)
                        .on('click', () => showPuskesmasDetails(puskesmas));
                    puskesmasMarkers.push(marker);
                }
            });
    
            if (puskesmasMarkers.length > 0) {
                const group = L.featureGroup(puskesmasMarkers);
                map.fitBounds(group.getBounds());
            } else {
                map.setView([-7.0000, 107.0000], 10);
            }
        }
    
        function showPuskesmasDetails(puskesmas) {
            const detailsContainer = document.getElementById('puskesmas-details');
            detailsContainer.innerHTML = `
                <div>
                    <h3 class="text-lg font-semibold text-blue-800">${puskesmas.nama}</h3>
                    <p class="text-sm text-gray-600 mb-1"><strong>Alamat:</strong> ${puskesmas.alamat}</p>
                    ${puskesmas.hotline_service ? `<p class="text-sm text-gray-600 mb-1"><strong>Hotline:</strong> ${puskesmas.hotline_service}</p>` : ''}
                    ${puskesmas.rawat_jalan ? `<p class="text-sm text-gray-600 mb-1"><strong>Rawat Jalan:</strong> Ya</p>` : ''}
                    ${puskesmas.poned ? `<p class="text-sm text-gray-600 mb-1"><strong>PONED:</strong> Ya</p>` : ''}
                    ${puskesmas.dtp ? `<p class="text-sm text-gray-600 mb-1"><strong>DTP:</strong> Ya</p>` : ''}
                    <p class="text-sm text-gray-600"><strong>Koordinat:</strong> ${puskesmas.latitude}, ${puskesmas.longitude}</p>
                </div>
            `;
        }
    
        window.onload = async () => {
            const response = await fetch('/wilayah/1/puskesmas');
            const data = await response.json();
            updateMapMarkers(data);
        };
    </script>
    
</body>

</html>
