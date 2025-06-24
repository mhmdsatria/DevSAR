@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-6 sm:mt-10 p-4 sm:p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white border-b pb-2 mb-6">
        {{ isset($post) ? 'Edit' : 'Tambah' }} Berita
    </h2>

    <form action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($post))
            @method('PUT')
        @endif

        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-200 p-4 mb-4 rounded text-sm">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-4"> {{-- Menggunakan space-y untuk jarak antar field --}}
            <div class="mb-4">
                <label for="title" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Berita</label>
                <input type="text" id="title" name="title"
                    value="{{ old('title', $post->title ?? '') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 text-sm sm:text-base">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-1">Penulis</label>
                <input type="text" id="author" name="author"
                    value="{{ old('author', $post->author ?? auth()->user()->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 text-sm sm:text-base">
                @error('author') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-1">Isi Berita</label>
                <textarea id="body" name="body" rows="5" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 text-sm sm:text-base">{{ old('body', $post->body ?? '') }}</textarea>
                @error('body') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm sm:text-base font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar</label>
                @if (isset($post) && $post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Gambar Berita" class="w-full max-w-xs sm:max-w-sm h-auto mb-3 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Tidak ada gambar yang dipilih.</p>
                @endif
                <input type="file" id="image" name="image" accept="image/*"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                           dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 p-2.5">
                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-end mt-6 gap-3">
            <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-md shadow
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                           text-sm sm:text-base">
                Simpan
            </button>
            <a href="{{ route('admin.posts.index') }}"
               class="w-full sm:w-auto text-center px-6 py-2.5 rounded-md border border-gray-300 dark:border-gray-600
                      text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition
                      text-sm sm:text-base">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection