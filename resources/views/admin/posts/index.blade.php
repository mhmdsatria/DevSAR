@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
    <!-- Header & Tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Daftar Berita</h1>
        <a href="{{ route('admin.posts.create') }}"
           class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md shadow
                  text-sm sm:text-base text-center">
            + Tambah Berita
        </a>
    </div>

    <!-- Notifikasi sukses -->
    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-5 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-200 dark:border-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-3 py-2 sm:px-4 sm:py-3 border-b border-gray-200 dark:border-gray-600 text-left text-xs sm:text-sm">No</th>
                    <th class="px-3 py-2 sm:px-4 sm:py-3 border-b border-gray-200 dark:border-gray-600 text-left text-xs sm:text-sm">Judul</th>
                    <th class="px-3 py-2 sm:px-4 sm:py-3 border-b border-gray-200 dark:border-gray-600 text-left text-xs sm:text-sm">Penulis</th>
                    <th class="px-3 py-2 sm:px-4 sm:py-3 border-b border-gray-200 dark:border-gray-600 text-left text-xs sm:text-sm whitespace-nowrap">Tanggal</th>
                    <th class="px-3 py-2 sm:px-4 sm:py-3 border-b border-gray-200 dark:border-gray-600 text-center text-xs sm:text-sm w-24 sm:w-auto">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-gray-300">
                @forelse ($posts as $key => $post)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm">{{ $key + 1 }}</td>
                        <td class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm font-medium whitespace-normal">{{ $post->title }}</td>
                        <td class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm whitespace-nowrap">{{ $post->author }}</td>
                        <td class="px-3 py-2 sm:px-4 sm:py-3 text-xs sm:text-sm whitespace-nowrap">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="px-3 py-2 sm:px-4 sm:py-3 text-center">
                            <div class="flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-2">
                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                   class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md text-xs sm:text-sm text-center">
                                    Edit
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')"
                                      class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md text-xs sm:text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm sm:text-base">
                            Belum ada berita yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection