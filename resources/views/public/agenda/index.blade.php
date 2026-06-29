@extends('layouts.public')

@section('title', 'Agenda')
@section('meta_description', 'Agenda kegiatan Taman Seminari ITCI')

@section('content')

{{-- Hero --}}
<div class="bg-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Agenda</h1>
        <p class="text-green-200">Jadwal agenda Taman Seminari ITCI</p>
    </div>
</div>

{{-- Daftar Agenda --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($events->count() > 0)
            <div class="space-y-6">
                @foreach ($events as $event)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row">
                            {{-- Tanggal --}}
                            <div class="bg-green-700 text-white p-6 md:w-32 flex flex-row md:flex-col items-center justify-center gap-2">
                                <div class="text-3xl font-bold">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
                                <div class="text-sm font-medium uppercase">{{ \Carbon\Carbon::parse($event->event_date)->format('M Y') }}</div>
                            </div>
                            {{-- Konten --}}
                            <div class="p-6 flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $event->title }}</h3>
                                @if ($event->description)
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ strip_tags($event->description) }}</p>
                                @endif
                                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                    <span><i class="far fa-clock mr-1 text-green-600"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }} WITA</span>
                                    @if ($event->location)
                                        <span><i class="fas fa-map-marker-alt mr-1 text-green-600"></i>{{ $event->location }}</span>
                                    @endif
                                </div>
                            </div>
                            @if ($event->poster)
                                <div class="md:w-32 p-2 flex items-center">
                                    <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->title }}" class="w-full h-24 object-cover rounded-lg">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-16 text-gray-400">
                <i class="fas fa-calendar-check text-5xl mb-4"></i>
                <p class="text-xl">Belum ada agenda.</p>
            </div>
        @endif
    </div>
</section>

@endsection
