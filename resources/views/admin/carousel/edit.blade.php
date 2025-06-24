@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Edit Gambar Carousel</h1>
    <form action="{{ route('admin.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Gambar Lama</label>
            <img src="{{ asset('storage/' . $carousel->image) }}" class="w-32 h-32 object-cover mb-2">
        </div>
        <div class="mb-4">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="image" class="block w-full mt-1">
        </div>
        <div class="mb-4">
            <label>Judul</label>
            <input type="text" name="title" value="{{ $carousel->title }}" class="block w-full mt-1">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
