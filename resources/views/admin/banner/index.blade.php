@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari banner..." value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent w-64">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button onclick="openModal('modalBanner', null)"
                    class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Banner
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="px-6 py-4 bg-gray-50 border-b">
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Gambar</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Judul</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Subjudul</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aktif</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                @if($banner->image)
                                    <img src="{{ asset('storage/'.$banner->image) }}" class="h-20 w-20 object-cover rounded">
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $banner->title }}</td>
                            <td class="px-4 py-3 text-sm">{{ $banner->subtitle ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($banner->is_active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <button onclick="openModal('modalBanner', {{ json_encode($banner) }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
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
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada banner.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $banners->links() }}
        </div>
    </div>

    {{-- Modal --}}
    <div id="modalBanner" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4 max-h-screen overflow-y-auto">
            <form id="formBanner" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="_method" id="methodBanner" value="POST">

                <h3 id="modalBannerTitle" class="text-lg font-semibold mb-4">Tambah Banner</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" id="banner_title" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subjudul</label>
                        <input type="text" name="subtitle" id="banner_subtitle"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image" id="banner_image"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <div id="banner_image_preview" class="mt-2 hidden">
                            <img src="" class="h-20 w-20 object-cover rounded">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol</label>
                        <input type="text" name="button_text" id="banner_button_text"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Tombol</label>
                        <input type="text" name="button_url" id="banner_button_url"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                        <input type="number" name="order" id="banner_order" value="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="banner_is_active" value="1"
                               class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <label for="banner_is_active" class="text-sm font-medium text-gray-700">Aktif</label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalBanner')"
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

            const form = document.getElementById('formBanner');
            const title = document.getElementById('modalBannerTitle');
            const method = document.getElementById('methodBanner');

            if (data) {
                title.textContent = 'Edit Banner';
                method.value = 'PUT';
                form.action = '{{ url("/admin/banner") }}' + '/' + data.id;
                document.getElementById('banner_title').value = data.title || '';
                document.getElementById('banner_subtitle').value = data.subtitle || '';
                document.getElementById('banner_button_text').value = data.button_text || '';
                document.getElementById('banner_button_url').value = data.button_url || '';
                document.getElementById('banner_order').value = data.order || 0;
                document.getElementById('banner_is_active').checked = data.is_active == 1;

                const preview = document.getElementById('banner_image_preview');
                if (data.image) {
                    preview.classList.remove('hidden');
                    preview.querySelector('img').src = '{{ asset("storage/") }}/' + data.image;
                } else {
                    preview.classList.add('hidden');
                }
            } else {
                title.textContent = 'Tambah Banner';
                method.value = 'POST';
                form.action = '{{ route("admin.banner.store") }}';
                form.reset();
                document.getElementById('banner_image_preview').classList.add('hidden');
                document.getElementById('banner_is_active').checked = true;
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
