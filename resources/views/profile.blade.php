@extends('layouts.app')

@section('title', 'Pengaturan Profil') {{-- Changed title to Indonesian for consistency --}}

@section('contents')
<div class="container mx-auto px-4 py-8"> {{-- Added a container for better spacing on various screens --}}
    <h1 class="text-2xl font-bold text-gray-800 mb-6 md:text-3xl">Pengaturan Profil</h1> {{-- Responsive heading --}}
    <hr class="mb-6 border-gray-300" /> {{-- Added margin-bottom and simplified hr --}}

    {{-- Assuming this form will update the user's profile --}}
    <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}"> {{-- Added a placeholder route name --}}
        @csrf {{-- CSRF protection is crucial for forms in Laravel --}}
        @method('PUT') {{-- Use PUT method for updating resources --}}

        <div class="mb-4"> {{-- Added margin-bottom for spacing --}}
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Lengkap
            </label>
            <input name="name" id="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                   class="w-full input input-bordered bg-white dark:bg-gray-700 dark:text-white border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 text-sm sm:text-base" /> {{-- Added Tailwind form styling and old() helper --}}
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6"> {{-- Added margin-bottom for spacing --}}
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            <input name="email" id="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                   class="w-full input input-bordered bg-white dark:bg-gray-700 dark:text-white border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 text-sm sm:text-base" />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- You might want to add password change fields here, or a link to a separate password change page --}}
        {{-- For example:
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
            <input name="password" id="password" type="password" placeholder="Biarkan kosong jika tidak ingin mengubah"
                   class="w-full input input-bordered bg-white dark:bg-gray-700 dark:text-white border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 text-sm sm:text-base" />
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
            <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Konfirmasi kata sandi baru"
                   class="w-full input input-bordered bg-white dark:bg-gray-700 dark:text-white border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 text-sm sm:text-base" />
        </div>
        --}}

        <div class="mt-6">
            <button type="submit" class="btn btn-primary w-full py-2 px-4 rounded-md text-white font-semibold text-sm sm:text-base hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Simpan Profil
            </button>
        </div>
    </form>
</div>
@endsection