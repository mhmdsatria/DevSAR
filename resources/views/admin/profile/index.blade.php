@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Profil Puskesmas</h2>

    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 p-4 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if ($profile)
        <div class="space-y-6">
            {{-- Nama Puskesmas --}}
            <div>
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama Puskesmas:</p>
                <p class="text-lg text-gray-900 dark:text-white">{{ $profile->nama_puskesmas }}</p>
            </div>

            {{-- Email Puskesmas --}}
            <div>
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Email Puskesmas:</p>
                <p class="text-lg text-gray-900 dark:text-white">{{ $profile->email }}</p>
            </div>

            {{-- Nomor Telepon --}}
            @if ($profile->telepon)
            <div>
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nomor Telepon:</p>
                <p class="text-lg text-gray-900 dark:text-white">{{ $profile->telepon }}</p>
            </div>
            @endif

            {{-- Alamat --}}
            <div>
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Alamat:</p>
                <p class="text-lg text-gray-900 dark:text-white">{{ $profile->alamat }}</p>
            </div>

            {{-- Struktur Organisasi --}}
            @if ($profile->struktur_organisasi)
            <div class="mt-8">
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Struktur Organisasi:</p>
                <img src="{{ asset('storage/' . $profile->struktur_organisasi) }}"
                     alt="Struktur Organisasi" class="w-full max-w-lg h-auto rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
            </div>
            @endif
        </div>

        {{-- Edit Profile Button --}}
        <div class="mt-8 text-right">
            <a href="{{ route('admin.profile.edit', $profile->id) }}"
               class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                      focus:ring-blue-300 font-medium rounded-lg text-base px-8 py-3
                      dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit Profil
            </a>
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">Belum ada data profil puskesmas.</p>
        <div class="text-center">
            <a href="{{ route('admin.profile.create') }}"
               class="inline-block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none
                      focus:ring-green-300 font-medium rounded-lg text-base px-8 py-3
                      dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                Tambahkan Profil
            </a>
        </div>
    @endif
</div>
@endsection