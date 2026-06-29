@extends('layouts.public')

@section('title', 'Visi & Misi')
@section('meta_description', 'Visi dan Misi Taman Seminari ITCI')

@section('content')

{{-- Hero --}}
<div class="bg-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Visi & Misi</h1>
        <p class="text-green-200">Taman Seminari ITCI</p>
    </div>
</div>

{{-- Visi --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-green-50 p-8 md:p-12 rounded-xl shadow-md">
            <h2 class="text-3xl font-bold text-green-800 mb-8 flex items-center">
                <i class="fas fa-eye text-green-600 mr-3"></i>Visi
            </h2>
            @forelse ($visions as $vision)
                <div class="flex items-start mb-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold mt-1">
                        {{ $loop->iteration }}
                    </div>
                    <p class="ml-4 text-gray-700 text-lg">{{ $vision->vision }}</p>
                </div>
            @empty
                <p class="text-gray-400 italic">Belum ada visi.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Misi --}}
<section class="py-16 bg-green-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 md:p-12 rounded-xl shadow-md">
            <h2 class="text-3xl font-bold text-green-800 mb-8 flex items-center">
                <i class="fas fa-bullseye text-green-600 mr-3"></i>Misi
            </h2>
            @forelse ($missions as $mission)
                <div class="flex items-start mb-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold mt-1">
                        {{ $loop->iteration }}
                    </div>
                    <p class="ml-4 text-gray-700 text-lg">{{ $mission->mission }}</p>
                </div>
            @empty
                <p class="text-gray-400 italic">Belum ada misi.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Nilai-nilai --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-green-800 mb-10">Nilai-nilai</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="p-6 bg-green-50 rounded-xl shadow-sm">
                <div class="text-4xl text-green-600 mb-3"><i class="fas fa-heart"></i></div>
                <h3 class="font-bold text-lg text-green-800 mb-2">Kasih</h3>
                <p class="text-gray-500 text-sm">Mengasihi sesama dengan tulus dan tanpa syarat</p>
            </div>
            <div class="p-6 bg-green-50 rounded-xl shadow-sm">
                <div class="text-4xl text-green-600 mb-3"><i class="fas fa-hand-holding-heart"></i></div>
                <h3 class="font-bold text-lg text-green-800 mb-2">Pelayanan</h3>
                <p class="text-gray-500 text-sm">Melayani dengan sepenuh hati dan dedikasi tinggi</p>
            </div>
            <div class="p-6 bg-green-50 rounded-xl shadow-sm">
                <div class="text-4xl text-green-600 mb-3"><i class="fas fa-graduation-cap"></i></div>
                <h3 class="font-bold text-lg text-green-800 mb-2">Unggul</h3>
                <p class="text-gray-500 text-sm">Senantiasa berkembang menuju yang terbaik</p>
            </div>
        </div>
    </div>
</section>

@endsection
