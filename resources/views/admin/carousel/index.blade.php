@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Carousel</h1>
    <a href="{{ route('admin.carousels.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Gambar</a>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($carousels as $carousel)
            <div class="bg-white p-4 rounded shadow">
                <img src="{{ asset('storage/' . $carousel->image) }}" class="w-full h-48 object-cover mb-2">
                <p class="text-center">{{ $carousel->title }}</p>
                <div class="flex justify-between mt-2">
                    <form action="{{ route('admin.carousels.destroy', $carousel) }}" method="POST" onsubmit="return confirm('Hapus gambar ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-full shadow">
                            Hapus
                        </button>
                    </form>
                    
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
