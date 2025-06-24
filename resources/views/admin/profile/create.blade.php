@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">
        {{ isset($profile) ? 'Edit Profil Puskesmas' : 'Tambah Profil Puskesmas' }}
    </h2>

    <form action="{{ isset($profile) ? route('admin.profile.update', $profile->id) : route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($profile))
            @method('PUT')
        @endif

        <div class="space-y-6">
            {{-- Nama Puskesmas --}}
            <div>
                <label for="nama_puskesmas" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Puskesmas</label>
                <input type="text" name="nama_puskesmas" id="nama_puskesmas"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                              focus:outline-none focus:ring-blue-500 focus:border-blue-500
                              bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                       value="{{ old('nama_puskesmas', $profile->nama_puskesmas ?? '') }}" required>
                @error('nama_puskesmas')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Puskesmas --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Puskesmas</label>
                <input type="email" name="email" id="email"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                              focus:outline-none focus:ring-blue-500 focus:border-blue-500
                              bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                       value="{{ old('email', $profile->email ?? '') }}" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3"
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                                 focus:outline-none focus:ring-blue-500 focus:border-blue-500
                                 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                          required>{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                @error('alamat')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Struktur Organisasi --}}
            <div>
                <label for="struktur_organisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Struktur Organisasi (Gambar)</label>
                <input type="file" name="struktur_organisasi" id="struktur_organisasi"
                       class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300 dark:hover:file:bg-blue-800">
                @if(isset($profile) && $profile->struktur_organisasi)
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $profile->struktur_organisasi) }}" alt="Struktur Organisasi" class="mt-2 max-w-xs h-auto rounded-md shadow">
                @endif
                @error('struktur_organisasi')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8">
            <button type="submit"
                    class="w-full inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md
                           text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                           dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                {{ isset($profile) ? 'Update Profil' : 'Simpan Profil' }}
            </button>
        </div>
    </form>
</div>
@endsection