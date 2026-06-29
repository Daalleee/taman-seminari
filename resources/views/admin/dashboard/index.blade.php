@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Total Berita --}}
        <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-2xl">
                <i class="fas fa-newspaper"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBerita }}</p>
                <p class="text-sm text-gray-500">Total Berita</p>
                <a href="{{ route('admin.berita.index') }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Lihat detail</a>
            </div>
        </div>

        {{-- Total Kegiatan --}}
        <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-2xl">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalKegiatan }}</p>
                <p class="text-sm text-gray-500">Total Kegiatan</p>
                <a href="{{ route('admin.kegiatan.index') }}" class="text-xs text-green-600 hover:underline mt-1 inline-block">Lihat detail</a>
            </div>
        </div>

        {{-- Total Album --}}
        <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-2xl">
                <i class="fas fa-folder"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalAlbum }}</p>
                <p class="text-sm text-gray-500">Total Album</p>
                <a href="{{ route('admin.album.index') }}" class="text-xs text-purple-600 hover:underline mt-1 inline-block">Lihat detail</a>
            </div>
        </div>

        {{-- Total Pesan --}}
        <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 text-2xl">
                <i class="fas fa-envelope"></i>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalPesan }}</p>
                <p class="text-sm text-gray-500">Total Pesan</p>
                <a href="{{ route('admin.pesan') }}" class="text-xs text-yellow-600 hover:underline mt-1 inline-block">Lihat detail</a>
            </div>
        </div>

    </div>
@endsection
