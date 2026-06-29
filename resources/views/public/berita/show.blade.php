@extends('layouts.public')

@section('title', $news->title)
@section('meta_description', $news->excerpt ?? Str::limit(strip_tags($news->content), 160))

@section('content')

{{-- Hero Kecil --}}
<div class="bg-green-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('public.berita') }}" class="text-green-200 hover:text-white transition mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Berita
        </a>
    </div>
</div>

<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($news->thumbnail)
            <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full h-80 md:h-96 object-cover">
            </div>
        @endif

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6">
            @if ($news->category)
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">{{ $news->category->name }}</span>
            @endif
            @if ($news->published_at)
                <span><i class="far fa-clock mr-1 text-green-600"></i>{{ \Carbon\Carbon::parse($news->published_at)->format('d F Y') }}</span>
            @endif
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $news->title }}</h1>

        @if ($news->excerpt)
            <p class="text-lg text-gray-500 italic mb-6 border-l-4 border-green-500 pl-4">{{ $news->excerpt }}</p>
        @endif

        <div class="prose max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($news->content)) !!}
        </div>

        {{-- Share --}}
        <div class="mt-10 pt-6 border-t flex items-center gap-4">
            <span class="text-sm font-semibold text-gray-600">Bagikan:</span>
            <button onclick="copyLink()" class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition text-sm font-medium">
                <i class="fas fa-link mr-1"></i>Salin Tautan
            </button>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm">
                <i class="fab fa-facebook mr-1"></i>Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank" class="px-4 py-2 bg-blue-100 text-blue-400 rounded-lg hover:bg-blue-200 transition text-sm">
                <i class="fab fa-twitter mr-1"></i>Twitter
            </a>
            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . request()->url()) }}" target="_blank" class="px-4 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition text-sm">
                <i class="fab fa-whatsapp mr-1"></i>WhatsApp
            </a>
        </div>

        <div class="mt-6">
            <a href="{{ route('public.berita') }}" class="inline-flex items-center text-green-700 hover:text-green-800 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Berita
            </a>
        </div>
    </div>
</section>

<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Tautan berhasil disalin!');
    });
}
</script>

@endsection
