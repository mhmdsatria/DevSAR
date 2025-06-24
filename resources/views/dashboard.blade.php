@extends('layouts.app')

@section('title', 'Selamat Datang di Halaman Admin Puskesmas')

@section('content')
<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    
    {{-- Gambar Latar --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/login.png') }}"
             alt="Latar Belakang Puskesmas"
             class="w-full h-full object-cover object-center"
             onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
    </div>

    

    {{-- Konten Hero --}}
    <div class="relative z-20 text-white text-center p-6 sm:p-8">
        <div class="">
            <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">Selamat Datang</h1>
            <p class="text-lg sm:text-xl mb-6">Di halaman admin Puskesmas</p>
            <a href="{{ route('admin.profile.index') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg px-6 py-3 rounded-full transition-transform transform hover:scale-105 shadow-lg">
                Mulai Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
