@extends('layouts.public')

@section('title', $activity->title)
@section('meta_description', Str::limit(strip_tags($activity->description), 160))

@section('content')

{{-- Hero Kecil --}}
<div class="bg-green-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('public.kegiatan') }}" class="text-green-200 hover:text-white transition mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kegiatan
        </a>
    </div>
</div>

<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($activity->thumbnail)
            <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                <img src="{{ asset('storage/' . $activity->thumbnail) }}" alt="{{ $activity->title }}" class="w-full h-80 md:h-96 object-cover">
            </div>
        @endif

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6">
            @if ($activity->category)
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">{{ $activity->category->name }}</span>
            @endif
            @if ($activity->activity_date)
                <span><i class="far fa-calendar-alt mr-1 text-green-600"></i>{{ \Carbon\Carbon::parse($activity->activity_date)->format('d F Y') }}</span>
            @endif
            @if ($activity->location)
                <span><i class="fas fa-map-marker-alt mr-1 text-green-600"></i>{{ $activity->location }}</span>
            @endif
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $activity->title }}</h1>

        <div class="prose max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($activity->description)) !!}
        </div>

        <div class="mt-10 pt-6 border-t">
            <a href="{{ route('public.kegiatan') }}" class="inline-flex items-center text-green-700 hover:text-green-800 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kegiatan
            </a>
        </div>
    </div>
</section>

@endsection
