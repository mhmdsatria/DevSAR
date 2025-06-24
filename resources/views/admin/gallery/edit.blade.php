@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-6 sm:mt-10 p-4 sm:p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white border-b pb-2 mb-6">Edit Galeri</h2>

        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-200 p-4 mb-4 rounded text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-4">
                <div class="mb-4">
                    <label for="title" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Galeri</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 text-sm sm:text-base">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Galeri</label>
                    @if ($gallery->image_path)
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}"
                             class="w-full max-w-xs sm:max-w-sm h-auto mb-3 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                                  dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 p-2.5">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Kosongkan jika tidak ingin mengganti gambar.</p>
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-end mt-6 gap-3">
                <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-md shadow
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               text-sm sm:text-base">
                    Update Galeri
                </button>
                <a href="{{ route('admin.galleries.index') }}"
                   class="w-full sm:w-auto text-center px-6 py-2.5 rounded-md border border-gray-300 dark:border-gray-600
                          text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition
                          text-sm sm:text-base">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection