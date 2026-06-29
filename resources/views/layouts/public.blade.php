<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Taman Seminari ITCI - Website resmi Taman Seminari ITCI')">
    <meta name="keywords" content="Taman Seminari, ITCI, Seminari, @yield('meta_keywords', '')">
    <title>@yield('title', 'Beranda') - Taman Seminari ITCI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-slide { transition: opacity 0.8s ease-in-out; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <i class="fas fa-tree text-green-800 text-2xl"></i>
                        <span class="font-bold text-xl text-green-800">Taman Seminari ITCI</span>
                    </a>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-1">
                    @php
                        $menuItems = [
                            ['route' => 'home', 'label' => 'Beranda'],
                            ['route' => 'public.profil', 'label' => 'Profil'],
                            ['route' => 'public.visi-misi', 'label' => 'Visi & Misi'],
                            ['route' => 'public.kegiatan', 'label' => 'Kegiatan'],
                            ['route' => 'public.berita', 'label' => 'Berita'],
                            ['route' => 'public.galeri', 'label' => 'Galeri'],
                            ['route' => 'public.agenda', 'label' => 'Agenda'],
                            ['route' => 'public.kontak', 'label' => 'Kontak'],
                            ['route' => 'public.faq', 'label' => 'FAQ'],
                        ];
                        $currentRoute = Route::currentRouteName();
                    @endphp
                    @foreach ($menuItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="px-3 py-2 rounded-md text-sm font-medium transition
                                  {{ $currentRoute === $item['route'] ? 'text-green-800 bg-green-100 font-semibold' : 'text-gray-600 hover:text-green-800 hover:bg-green-50' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                {{-- Mobile Hamburger --}}
                <div class="md:hidden flex items-center">
                    <button id="hamburger" class="text-gray-600 hover:text-green-800 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-2 space-y-1">
                @foreach ($menuItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="block px-3 py-2 rounded-md text-base font-medium transition
                              {{ $currentRoute === $item['route'] ? 'text-green-800 bg-green-100 font-semibold' : 'text-gray-600 hover:text-green-800 hover:bg-green-50' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @php
        $setting = \App\Models\Setting::first();
        $contactFooter = \App\Models\Contact::first();
    @endphp
    <footer class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Tentang --}}
                <div>
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-tree mr-2"></i>Taman Seminari ITCI
                    </h3>
                    <p class="text-green-200 text-sm leading-relaxed">
                        {{ $setting->footer ?? 'Taman Seminari ITCI adalah lembaga pendidikan yang berkomitmen untuk membentuk generasi muda yang unggul, beriman, dan berkarakter.' }}
                    </p>
                </div>

                {{-- Menu Cepat --}}
                <div>
                    <h3 class="text-lg font-bold mb-4">Menu Cepat</h3>
                    <ul class="space-y-2">
                        @foreach ($menuItems as $item)
                            <li>
                                <a href="{{ route($item['route']) }}"
                                   class="text-green-200 hover:text-white transition text-sm">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    @if ($contactFooter)
                        <div class="space-y-3 text-sm text-green-200">
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 w-4"></i>
                                {{ $contactFooter->address }}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-phone mr-3 w-4"></i>
                                {{ $contactFooter->phone }}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-envelope mr-3 w-4"></i>
                                {{ $contactFooter->email }}
                            </p>
                        </div>
                        <div class="flex space-x-3 mt-4">
                            @if ($contactFooter->facebook)
                                <a href="{{ $contactFooter->facebook }}" target="_blank" class="text-green-200 hover:text-white transition text-xl">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            @endif
                            @if ($contactFooter->instagram)
                                <a href="{{ $contactFooter->instagram }}" target="_blank" class="text-green-200 hover:text-white transition text-xl">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if ($contactFooter->youtube)
                                <a href="{{ $contactFooter->youtube }}" target="_blank" class="text-green-200 hover:text-white transition text-xl">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                        </div>
                    @else
                        <p class="text-green-200 text-sm">Belum ada data kontak.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-green-900 py-4">
            <div class="max-w-7xl mx-auto px-4 text-center text-sm text-green-300">
                {{ $setting->copyright ?? '© ' . date('Y') . ' Taman Seminari ITCI. All rights reserved.' }}
            </div>
        </div>
    </footer>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div id="flashMessage" class="fixed bottom-4 right-4 px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg flex items-center gap-2 z-50 animate-bounce">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="flashMessage" class="fixed bottom-4 right-4 px-6 py-3 bg-red-600 text-white rounded-lg shadow-lg flex items-center gap-2 z-50 animate-bounce">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <script>
        // Hamburger toggle
        document.getElementById('hamburger')?.addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        // Flash message auto-hide
        const flash = document.getElementById('flashMessage');
        if (flash) {
            setTimeout(() => { flash.style.display = 'none'; }, 5000);
        }
    </script>
    @stack('scripts')
</body>
</html>
