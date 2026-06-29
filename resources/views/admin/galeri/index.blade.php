@extends('admin.layouts.admin')

@section('title', 'Galeri')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex items-center gap-2 flex-wrap">
                <input type="text" name="search" placeholder="Cari caption..." value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent w-64">
                <select name="album_id"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Semua Album</option>
                    @foreach ($albums as $alb)
                        <option value="{{ $alb->id }}" {{ request('album_id') == $alb->id ? 'selected' : '' }}>{{ $alb->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-filter"></i>
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded text-sm">
                    <i class="fas fa-times"></i>
                </a>
            </form>
            <button onclick="openModal('modalGaleri', null)"
                    class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Gambar
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="px-6 py-4 bg-gray-50 border-b">
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Gambar</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Album</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Caption</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $gallery)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                @if($gallery->image)
                                    <img src="{{ asset('storage/'.$gallery->image) }}" class="h-20 w-20 object-cover rounded">
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $gallery->album->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $gallery->caption ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <button onclick="openModal('modalGaleri', {{ json_encode($gallery) }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
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
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada galeri.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $galleries->links() }}
        </div>
    </div>

    {{-- Modal --}}
    <div id="modalGaleri" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
            <form id="formGaleri" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="_method" id="methodGaleri" value="POST">

                <h3 id="modalGaleriTitle" class="text-lg font-semibold mb-4">Tambah Gambar</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Album</label>
                        <select name="album_id" id="galeri_album_id" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">-- Pilih Album --</option>
                            @foreach ($albums as $alb)
                                <option value="{{ $alb->id }}">{{ $alb->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image" id="galeri_image"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <div id="galeri_image_preview" class="mt-2 hidden">
                            <img src="" class="h-20 w-20 object-cover rounded">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
                        <textarea name="caption" id="galeri_caption" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalGaleri')"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded text-sm">Batal</button>
                    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, data) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            const form = document.getElementById('formGaleri');
            const title = document.getElementById('modalGaleriTitle');
            const method = document.getElementById('methodGaleri');

            if (data) {
                title.textContent = 'Edit Gambar';
                method.value = 'PUT';
                form.action = '{{ url("/admin/galeri") }}' + '/' + data.id;
                document.getElementById('galeri_album_id').value = data.album_id || '';
                document.getElementById('galeri_caption').value = data.caption || '';

                const preview = document.getElementById('galeri_image_preview');
                if (data.image) {
                    preview.classList.remove('hidden');
                    preview.querySelector('img').src = '{{ asset("storage/") }}/' + data.image;
                } else {
                    preview.classList.add('hidden');
                }
            } else {
                title.textContent = 'Tambah Gambar';
                method.value = 'POST';
                form.action = '{{ route("admin.galeri.store") }}';
                form.reset();
                document.getElementById('galeri_image_preview').classList.add('hidden');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('click', function(e) {
            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    </script>
@endsection
