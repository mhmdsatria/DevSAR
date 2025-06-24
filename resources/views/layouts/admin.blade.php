<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">

        {{-- Navbar --}}
        <nav class="bg-gray-100 text-white shadow-md">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                {{-- Logo / Brand --}}
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold">Admin Panel</a>

                {{-- Menu Navigasi --}}
                <div class="space-x-4">
                    <a href="{{ route('admin.galleries.index') }}" class="px-3 py-2 hover:bg-blue-700 rounded transition">Dokumentasi</a>
                    <a href="{{ route('admin.posts.index') }}" class="px-3 py-2 hover:bg-blue-700 rounded transition">Berita</a>
                    <a href="{{ route('admin.pelayanans.index') }}" class="px-3 py-2 hover:bg-blue-700 rounded transition">Layanan</a>
                </div>

                {{-- User Avatar + Logout --}}
                <div class="flex items-center gap-4">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full border-2 border-white">
                                <img alt="User Avatar" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white text-gray-700 rounded-box w-52">
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    <a href="{{ route('logout') }}" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600 transition">Logout</a>
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto p-6">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
