@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Tambah Carousel</h1>

        <form action="{{ route('admin.carousels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <h3 class="text-sm text-gray-500 mb-2">Ukuran Gambar : Lebar 1920 px, Tinggi 685 px</h3>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Carousel</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Simpan Carousel</button>
        </form>
    </div>
@endsection
