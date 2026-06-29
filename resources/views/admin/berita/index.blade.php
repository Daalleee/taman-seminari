@extends('admin.layouts.admin')

@section('title', 'Berita')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex items-center gap-2 flex-wrap">
                <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent w-64">
                <select name="category_id"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="status"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-filter"></i>
                </button>
                <a href="{{ route('admin.berita.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded text-sm">
                    <i class="fas fa-times"></i>
                </a>
            </form>
            <a href="{{ route('admin.berita.create') }}"
               class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Berita
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="px-6 py-4 bg-gray-50 border-b">
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Judul</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Kategori</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Tanggal Publish</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($newsList as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->title }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->category->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($item->status == 'published')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Published</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Draft</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <a href="{{ route('admin.berita.edit', $item->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $newsList->links() }}
        </div>
    </div>
@endsection
