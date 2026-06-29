@extends('layouts.public')

@section('title', 'Profil')
@section('meta_description', 'Profil Taman Seminari ITCI')

@section('content')

{{-- Hero --}}
<div class="bg-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Profil</h1>
        <p class="text-green-200">Taman Seminari ITCI</p>
    </div>
</div>

@if ($profile)
    {{-- Sejarah --}}
    @if ($profile->history)
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Sejarah</h2>
            <div class="prose max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($profile->history)) !!}
            </div>
        </div>
    </section>
    @endif

    {{-- Tentang Kami --}}
    @if ($profile->description)
    <section class="py-16 bg-green-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Tentang Kami</h2>
            <div class="prose max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($profile->description)) !!}
            </div>
        </div>
    </section>
    @endif

    {{-- Tujuan --}}
    @if ($profile->goal)
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Tujuan</h2>
            <div class="prose max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($profile->goal)) !!}
            </div>
        </div>
    </section>
    @endif

    {{-- Logo dan Makna --}}
    @if ($profile->logo)
    <section class="py-16 bg-green-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Logo dan Makna</h2>
            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo {{ $profile->name }}" class="w-48 h-48 object-contain mx-auto mb-6">
            <p class="text-gray-600">{{ $profile->name }}</p>
        </div>
    </section>
    @endif

    {{-- Motto --}}
    @if ($profile->motto)
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Motto</h2>
            <blockquote class="text-2xl italic text-green-700 font-semibold">
                "{{ $profile->motto }}"
            </blockquote>
        </div>
    </section>
    @endif
@else
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 text-center text-gray-400">
            <i class="fas fa-school text-5xl mb-4"></i>
            <p>Belum ada data profil.</p>
        </div>
    </section>
@endif

@endsection
