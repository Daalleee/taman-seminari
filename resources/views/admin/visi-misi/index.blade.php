@extends('admin.layouts.admin')

@section('title', 'Visi & Misi')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Visi --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Visi</h3>

            <form action="{{ route('admin.vision.store') }}" method="POST" class="flex gap-2 mb-4">
                @csrf
                <textarea name="vision" rows="2" placeholder="Tambah visi..." required
                          class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm whitespace-nowrap">
                    <i class="fas fa-plus"></i>
                </button>
            </form>

            @forelse ($visions as $vision)
                <div class="flex items-start justify-between border-b border-gray-100 py-3">
                    <form action="{{ route('admin.vision.update', $vision->id) }}" method="POST" class="flex-1 flex gap-2">
                        @csrf
                        @method('PUT')
                        <textarea name="vision" rows="2" required
                                  class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $vision->vision }}</textarea>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.vision.destroy', $vision->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus visi ini?')" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada visi.</p>
            @endforelse
        </div>

        {{-- Misi --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Misi</h3>

            <form action="{{ route('admin.mission.store') }}" method="POST" class="flex gap-2 mb-4">
                @csrf
                <textarea name="mission" rows="2" placeholder="Tambah misi..." required
                          class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm whitespace-nowrap">
                    <i class="fas fa-plus"></i>
                </button>
            </form>

            @forelse ($missions as $mission)
                <div class="flex items-start justify-between border-b border-gray-100 py-3">
                    <form action="{{ route('admin.mission.update', $mission->id) }}" method="POST" class="flex-1 flex gap-2">
                        @csrf
                        @method('PUT')
                        <textarea name="mission" rows="2" required
                                  class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $mission->mission }}</textarea>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.mission.destroy', $mission->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus misi ini?')" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada misi.</p>
            @endforelse
        </div>
    </div>
@endsection
