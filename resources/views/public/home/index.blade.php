@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

{{-- Hero Slider --}}
@if ($banners->count() > 0)
    <div x-data="{ active: 0 }" class="relative overflow-hidden">
        @foreach ($banners as $index => $banner)
            <div x-show="active === {{ $index }}" x-transition:enter="transition-opacity duration-800" class="relative h-[500px] md:h-[600px] flex items-center justify-center">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight">{{ $banner->title }}</h1>
                    @if ($banner->subtitle)
                        <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-2xl mx-auto">{{ $banner->subtitle }}</p>
                    @endif
                    @if ($banner->button_text && $banner->button_url)
                        <a href="{{ $banner->button_url }}" class="inline-block bg-green-700 hover:bg-green-800 text-white font-semibold px-8 py-3 rounded-lg transition shadow-lg">
                            {{ $banner->button_text }}
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
        @if ($banners->count() > 1)
            <div class="absolute bottom-6 left-0 right-0 z-20 flex justify-center space-x-2">
                @foreach ($banners as $index => $banner)
                    <button @click="active = {{ $index }}" class="w-3 h-3 rounded-full transition" :class="active === {{ $index }} ? 'bg-white' : 'bg-white bg-opacity-50'"></button>
                @endforeach
            </div>
            <button @click="active = active > 0 ? active - 1 : {{ $banners->count() - 1 }}" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 text-white text-3xl hover:text-green-300 transition">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button @click="active = active < {{ $banners->count() - 1 }} ? active + 1 : 0" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 text-white text-3xl hover:text-green-300 transition">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
@else
    <div class="h-[400px] md:h-[500px] bg-green-800 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Selamat Datang di Taman Seminari ITCI</h1>
            <p class="text-lg text-green-200">Membentuk generasi unggul, beriman, dan berkarakter</p>
        </div>
    </div>
@endif

{{-- Sambutan --}}
@if ($profile)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-10">
            @if ($profile->logo)
                <div class="flex-shrink-0">
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="{{ $profile->name }}" class="w-40 h-40 md:w-52 md:h-52 object-contain">
                </div>
            @endif
            <div>
                <h2 class="text-3xl font-bold text-green-800 mb-4">{{ $profile->name ?? 'Taman Seminari ITCI' }}</h2>
                <p class="text-gray-600 leading-relaxed">{{ Str::limit(strip_tags($profile->description), 500) }}</p>
                <a href="{{ route('public.profil') }}" class="inline-block mt-4 text-green-700 font-semibold hover:underline">
                    Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Visi & Misi --}}
<section class="py-16 bg-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-green-800 mb-12">Visi & Misi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center">
                    <i class="fas fa-eye mr-3"></i>Visi
                </h3>
                @forelse ($visions as $vision)
                    <p class="text-gray-600 mb-3 pl-6 border-l-4 border-green-500">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>{{ $vision->vision }}
                    </p>
                @empty
                    <p class="text-gray-400 italic">Belum ada visi.</p>
                @endforelse
            </div>
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h3 class="text-xl font-bold text-green-700 mb-6 flex items-center">
                    <i class="fas fa-bullseye mr-3"></i>Misi
                </h3>
                @forelse ($missions as $mission)
                    <p class="text-gray-600 mb-3 pl-6 border-l-4 border-green-500">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>{{ $mission->mission }}
                    </p>
                @empty
                    <p class="text-gray-400 italic">Belum ada misi.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- Kegiatan Terbaru --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-green-800">Kegiatan Terbaru</h2>
            <a href="{{ route('public.kegiatan') }}" class="text-green-700 hover:underline font-semibold">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($activities as $activity)
                <a href="{{ route('public.kegiatan.show', $activity->slug) }}" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group border">
                    <div class="h-48 bg-green-100 overflow-hidden">
                        @if ($activity->thumbnail)
                            <img src="{{ asset('storage/' . $activity->thumbnail) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-green-400 text-4xl">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-green-600 font-semibold mb-1">
                            @if ($activity->category)
                                {{ $activity->category->name }}
                            @endif
                            @if ($activity->activity_date)
                                <span class="ml-2 text-gray-400 font-normal">{{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}</span>
                            @endif
                        </p>
                        <h3 class="font-semibold text-gray-800 group-hover:text-green-700 transition line-clamp-2">{{ $activity->title }}</h3>
                    </div>
                </a>
            @empty
                <div class="col-span-4 text-center py-10 text-gray-400">
                    <i class="fas fa-calendar-alt text-4xl mb-3"></i>
                    <p>Belum ada kegiatan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Berita Terbaru --}}
<section class="py-16 bg-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-green-800">Berita Terbaru</h2>
            <a href="{{ route('public.berita') }}" class="text-green-700 hover:underline font-semibold">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($news as $item)
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
                        <p class="text-xs text-green-600 font-semibold mb-2">
                            @if ($item->category)
                                {{ $item->category->name }}
                            @endif
                            @if ($item->published_at)
                                <span class="ml-2 text-gray-400 font-normal">{{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}</span>
                            @endif
                        </p>
                        <h3 class="font-bold text-gray-800 group-hover:text-green-700 transition line-clamp-2 mb-2">{{ $item->title }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ $item->excerpt ?? strip_tags(Str::limit($item->content, 120)) }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-10 text-gray-400">
                    <i class="fas fa-newspaper text-4xl mb-3"></i>
                    <p>Belum ada berita.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Galeri --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-green-800">Galeri</h2>
            <a href="{{ route('public.galeri') }}" class="text-green-700 hover:underline font-semibold">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        @php
            $allItems = collect();
            foreach ($albums as $album) {
                $allItems = $allItems->concat($album->items);
            }
            $latestItems = $allItems->sortByDesc('created_at')->take(6);
        @endphp
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse ($latestItems as $item)
                <div class="group relative overflow-hidden rounded-lg shadow-md aspect-square cursor-pointer"
                     onclick="document.getElementById('lightbox-{{ $item->id }}').classList.remove('hidden')">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption ?? 'Galeri' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>
                {{-- Lightbox --}}
                <div id="lightbox-{{ $item->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-80 hidden flex items-center justify-center p-4" onclick="this.classList.add('hidden')">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption ?? 'Galeri' }}" class="max-w-full max-h-full rounded-lg shadow-2xl">
                    <button onclick="event.stopPropagation(); this.closest('[id^=lightbox-]').classList.add('hidden')" class="absolute top-4 right-4 text-white text-3xl hover:text-green-300 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @empty
                <div class="col-span-6 text-center py-10 text-gray-400">
                    <i class="fas fa-images text-4xl mb-3"></i>
                    <p>Belum ada galeri.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Statistik --}}
<section class="py-16 bg-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-yellow-400">{{ $activities->count() }}+</div>
                <div class="text-green-200 mt-2">Kegiatan</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-yellow-400">{{ $news->count() }}+</div>
                <div class="text-green-200 mt-2">Berita</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-yellow-400">{{ $albums->sum(fn($a) => $a->items->count()) }}+</div>
                <div class="text-green-200 mt-2">Foto</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-yellow-400">{{ \App\Models\Event::count() }}+</div>
                <div class="text-green-200 mt-2">Agenda</div>
            </div>
        </div>
    </div>
</section>

{{-- Google Maps --}}
@if ($contact && $contact->maps)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-green-800 mb-10">Lokasi Kami</h2>
        <div class="rounded-xl overflow-hidden shadow-lg">
            {!! $contact->maps !!}
        </div>
    </div>
</section>
@endif

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
