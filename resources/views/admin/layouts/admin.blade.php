<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Taman Seminari ITCI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    @php
        $sidebarMenus = [
            ['label' => 'Dashboard',       'icon' => 'fa-tachometer-alt',   'route' => 'admin.dashboard'],
            ['label' => 'Profil',          'icon' => 'fa-school',          'route' => 'admin.profil'],
            ['label' => 'Banner',          'icon' => 'fa-images',          'route' => 'admin.banner.index'],
            ['label' => 'Visi & Misi',     'icon' => 'fa-eye',            'route' => 'admin.visi-misi'],
            ['label' => 'Kategori Kegiatan', 'icon' => 'fa-tags',         'route' => 'admin.kategori-kegiatan.index'],
            ['label' => 'Kegiatan',        'icon' => 'fa-calendar-alt',    'route' => 'admin.kegiatan.index'],
            ['label' => 'Kategori Berita', 'icon' => 'fa-tags',           'route' => 'admin.kategori-berita.index'],
            ['label' => 'Berita',          'icon' => 'fa-newspaper',       'route' => 'admin.berita.index'],
            ['label' => 'Album',           'icon' => 'fa-folder',          'route' => 'admin.album.index'],
            ['label' => 'Galeri',          'icon' => 'fa-images',          'route' => 'admin.galeri.index'],
            ['label' => 'Agenda',          'icon' => 'fa-calendar-check',  'route' => 'admin.agenda.index'],
            ['label' => 'Kontak',          'icon' => 'fa-address-card',    'route' => 'admin.kontak'],
            ['label' => 'Pesan',           'icon' => 'fa-envelope',        'route' => 'admin.pesan'],
            ['label' => 'Pengaturan',      'icon' => 'fa-cogs',            'route' => 'admin.pengaturan'],
            ['label' => 'Akun Admin',      'icon' => 'fa-user-cog',        'route' => 'admin.akun-admin'],
        ];
        $currentRoute = Route::currentRouteName();
    @endphp

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside class="w-64 bg-green-800 text-white flex-shrink-0 overflow-y-auto hidden md:block">
            <div class="p-4 border-b border-green-700">
                <h1 class="text-lg font-bold tracking-wide">
                    <i class="fas fa-tree mr-2"></i>Taman Seminari
                </h1>
            </div>
            <nav class="mt-2">
                @foreach ($sidebarMenus as $menu)
                    <a href="{{ route($menu['route']) }}"
                       class="flex items-center px-4 py-3 text-sm hover:bg-green-700 transition
                              {{ $currentRoute === $menu['route'] ? 'bg-green-700 font-semibold border-l-4 border-yellow-400' : '' }}">
                        <i class="fas {{ $menu['icon'] }} w-5 text-center mr-3"></i>
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Topbar --}}
            <header class="bg-white shadow-sm px-6 py-3 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('title', 'Dashboard')
                </h2>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <div class="w-8 h-8 rounded-full bg-green-700 flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 transition">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mx-6 mt-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mx-6 mt-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
