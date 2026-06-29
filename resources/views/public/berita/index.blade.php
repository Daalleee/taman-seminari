@extends('layouts.public')

@section('title', 'Berita')
@section('meta_description', 'Berita Taman Seminari ITCI')

@section('content')

{{-- Hero --}}
<div class="bg-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Berita</h1>
        <p class="text-green-200">Informasi dan berita terbaru Taman Seminari ITCI</p>
    </div>
</div>

{{-- Filter Kategori --}}
<section class="py-8 bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap gap-2 justify-center">
            <a href="{{ route('public.berita') }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition
                      {{ !request('category_id') ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-green-100 hover:text-green-700' }}">
                Semua
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('public.berita', ['category_id' => $category->id]) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition
                          {{ request('category_id') == $category->id ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-green-100 hover:text-green-700' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Daftar Berita --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($newsList->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($newsList as $item)
                    <a href="{{ route('public.berita.show', $item->slug) }}" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group border">
                        <div class="h-52 bg-green-100 overflow-hidden">
                            @if ($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-green-400 text-4xl">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-xs mb-3">
                                @if ($item->category)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full font-semibold">{{ $item->category->name }}</span>
                                @endif
                                @if ($item->published_at)
                                    <span class="text-gray-400"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}</span>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-800 group-hover:text-green-700 transition line-clamp-2 mb-2">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-3">{{ $item->excerpt ?? strip_tags(Str::limit($item->content, 150)) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $newsList->links() }}
            </div>
        @else
            <div class="text-center py-16 text-gray-400">
                <i class="fas fa-newspaper text-5xl mb-4"></i>
                <p class="text-xl">Belum ada berita.</p>
            </div>
        @endif
    </div>
</section>

@endsection
