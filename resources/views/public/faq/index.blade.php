@extends('layouts.public')

@section('title', 'FAQ')
@section('meta_description', 'Pertanyaan yang sering diajukan Taman Seminari ITCI')

@section('content')

{{-- Hero --}}
<div class="bg-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">FAQ</h1>
        <p class="text-green-200">Pertanyaan yang Sering Diajukan</p>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $faqs = [
                [
                    'q' => 'Apa itu Taman Seminari ITCI?',
                    'a' => 'Taman Seminari ITCI adalah lembaga pendidikan yang berfokus pada pembentukan karakter dan pengembangan spiritual generasi muda. Kami menyediakan berbagai kegiatan dan program untuk mendukung pertumbuhan iman dan pengetahuan.'
                ],
                [
                    'q' => 'Bagaimana cara mendaftar sebagai peserta kegiatan?',
                    'a' => 'Untuk mendaftar sebagai peserta kegiatan, Anda dapat menghubungi kami melalui halaman Kontak atau datang langsung ke lokasi Taman Seminari ITCI. Informasi pendaftaran juga akan diumumkan melalui halaman Berita dan Kegiatan.'
                ],
                [
                    'q' => 'Apakah ada biaya untuk mengikuti kegiatan?',
                    'a' => 'Informasi mengenai biaya kegiatan akan disesuaikan dengan masing-masing program. Beberapa kegiatan mungkin gratis, sementara yang lain mungkin memerlukan biaya partisipasi. Silakan hubungi kami untuk informasi lebih lanjut.'
                ],
                [
                    'q' => 'Siapa saja yang dapat mengikuti kegiatan di Taman Seminari ITCI?',
                    'a' => 'Kegiatan di Taman Seminari ITCI terbuka untuk umum, terutama bagi generasi muda yang ingin mengembangkan diri secara spiritual, intelektual, dan sosial.'
                ],
                [
                    'q' => 'Bagaimana cara menghubungi Taman Seminari ITCI?',
                    'a' => 'Anda dapat menghubungi kami melalui nomor telepon, email, atau datang langsung ke alamat yang tertera di halaman Kontak. Kami juga aktif di media sosial Facebook, Instagram, dan YouTube.'
                ],
                [
                    'q' => 'Apakah Taman Seminari ITCI menyediakan beasiswa?',
                    'a' => 'Informasi mengenai beasiswa akan diumumkan melalui halaman Berita dan pengumuman resmi lainnya. Silakan pantau terus website kami untuk informasi terbaru.'
                ],
            ];
        @endphp

        <div class="space-y-4" x-data="{ active: null }">
            @foreach ($faqs as $index => $faq)
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex justify-between items-center p-5 text-left focus:outline-none hover:bg-green-50 transition">
                        <span class="font-semibold text-gray-800 pr-4">{{ $faq['q'] }}</span>
                        <i class="fas fa-chevron-down text-green-600 transition transform"
                           :class="active === {{ $index }} ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === {{ $index }}"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 max-h-0"
                         x-transition:enter-end="opacity-100 max-h-96"
                         class="px-5 pb-5 text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12 p-8 bg-white rounded-xl shadow-sm border">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Masih Punya Pertanyaan?</h3>
            <p class="text-gray-500 mb-4">Jangan ragu untuk menghubungi kami</p>
            <a href="{{ route('public.kontak') }}" class="inline-block bg-green-700 hover:bg-green-800 text-white font-semibold px-6 py-3 rounded-lg transition shadow-md">
                <i class="fas fa-envelope mr-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
