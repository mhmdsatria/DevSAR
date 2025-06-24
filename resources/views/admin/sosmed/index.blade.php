@extends('layouts.app')

@section('content')
<div class="container mx-auto p-5">
    <h1 class="text-2xl font-bold mb-6">Link Sosial Media</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        @foreach (['facebook', 'instagram', 'tiktok'] as $platform)
            <div class="bg-white shadow rounded-md p-4">
                <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">
                    {{ ucfirst($platform) }}
                </label>

                @if (!empty($data[$platform]?->url))
                    <div class="flex justify-between items-center">
                        <a href="{{ $data[$platform]->url }}" target="_blank" class="text-blue-600 underline break-all">
                            {{ $data[$platform]->url }}
                        </a>
                        <a href="{{ route('admin.sosmed.edit', $platform) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-3 py-1 rounded">
                            Edit
                        </a>
                    </div>
                @else
                    <div class="flex justify-between items-center">
                        <span class="text-red-500 italic">Belum diisi</span>
                        <a href="{{ route('admin.sosmed.create', ['platform' => $platform]) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-3 py-1 rounded">
                            Tambahkan
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
