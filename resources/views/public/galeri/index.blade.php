@extends('layouts.public')

@section('title', 'Galeri')
@section('meta_description', 'Galeri foto Taman Seminari ITCI')

@section('content')

{{-- Hero --}}
<div class="bg-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Galeri</h1>
        <p class="text-green-200">Dokumentasi foto Taman Seminari ITCI</p>
    </div>
</div>

{{-- Album Grid --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($albums->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($albums as $album)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border">
                        <div class="h-56 bg-green-100 overflow-hidden cursor-pointer"
                             onclick="document.getElementById('albumModal-{{ $album->id }}').classList.remove('hidden')">
                            @if ($album->cover)
                                <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->name }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            @elseif ($album->items->count() > 0)
                                <img src="{{ asset('storage/' . $album->items->first()->image) }}" alt="{{ $album->name }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-green-400 text-4xl">
                                    <i class="fas fa-images"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-gray-800 text-lg">{{ $album->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $album->items->count() }} foto</p>
                            <button onclick="document.getElementById('albumModal-{{ $album->id }}').classList.remove('hidden')"
                                    class="mt-3 text-green-700 hover:text-green-800 font-semibold text-sm">
                                <i class="fas fa-images mr-1"></i>Lihat Foto
                            </button>
                        </div>
                    </div>

                    {{-- Album Modal --}}
                    <div id="albumModal-{{ $album->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-80 hidden overflow-y-auto" onclick="if (event.target === this) this.classList.add('hidden')">
                        <div class="min-h-screen flex items-start justify-center p-4 pt-16">
                            <div class="bg-white rounded-xl max-w-5xl w-full p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $album->name }}</h3>
                                    <button onclick="this.closest('[id^=albumModal-]').classList.add('hidden')" class="text-gray-500 hover:text-gray-700 text-3xl">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @if ($album->items->count() > 0)
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        @foreach ($album->items as $item)
                                            <div class="group relative overflow-hidden rounded-lg aspect-square cursor-pointer"
                                                 onclick="document.getElementById('lightbox-{{ $item->id }}').classList.remove('hidden')">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption ?? 'Foto' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                                                    <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition"></i>
                                                </div>
                                            </div>
                                            {{-- Lightbox --}}
                                            <div id="lightbox-{{ $item->id }}" class="fixed inset-0 z-60 bg-black bg-opacity-90 hidden flex items-center justify-center p-4" onclick="this.classList.add('hidden')">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption ?? 'Foto' }}" class="max-w-full max-h-full rounded-lg shadow-2xl">
                                                @if ($item->caption)
                                                    <p class="absolute bottom-8 text-white text-center text-sm bg-black bg-opacity-50 px-4 py-2 rounded">{{ $item->caption }}</p>
                                                @endif
                                                <button onclick="event.stopPropagation(); this.closest('[id^=lightbox-]').classList.add('hidden')" class="absolute top-4 right-4 text-white text-3xl hover:text-green-300 transition">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-center text-gray-400 py-10">Belum ada foto dalam album ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-gray-400">
                <i class="fas fa-images text-5xl mb-4"></i>
                <p class="text-xl">Belum ada album galeri.</p>
            </div>
        @endif
    </div>
</section>

@endsection
