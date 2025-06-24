@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-6 sm:mt-10 p-4 sm:p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white border-b pb-2 mb-6">
        {{ isset($pelayanan) ? 'Edit Pelayanan' : 'Form Input Pelayanan' }}
    </h2>

    <form action="{{ isset($pelayanan) ? route('admin.pelayanans.update', $pelayanan->id) : route('admin.pelayanans.store') }}" method="POST">
        @csrf
        @if(isset($pelayanan)) @method('PUT') @endif

        <div class="space-y-4"> {{-- Mengganti <table> dengan <div> untuk layout yang lebih responsif --}}
            {{-- Judul --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                <input type="text" id="title" name="title"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                    value="{{ old('title', $pelayanan->title ?? '') }}" required>
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                <textarea id="description" name="description" rows="5"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                    required>{{ old('description', $pelayanan->description ?? '') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Hari --}}
            <div>
                <label for="days" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Hari</label>
                <input type="text" id="days" name="days"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                    value="{{ old('days', $pelayanan->days ?? '') }}" required>
                @error('days') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-end mt-6 gap-3">
            <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-md shadow
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                           text-sm sm:text-base">
                {{ isset($pelayanan) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.pelayanans.index') }}"
               class="w-full sm:w-auto text-center px-5 py-2 rounded-md border border-gray-300 dark:border-gray-600
                      text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition
                      text-sm sm:text-base">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection