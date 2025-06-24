@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Link Sosial Media</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.sosmed.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        @foreach (['facebook', 'instagram', 'tiktok'] as $platform)
            <div>
                <label for="{{ $platform }}" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ ucfirst($platform) }}
                </label>
                <input 
                    type="url"
                    id="{{ $platform }}"
                    name="{{ $platform }}"
                    value="{{ $data[$platform]->url ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    placeholder="https://{{ $platform }}.com/..."
                >
            </div>
        @endforeach

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
