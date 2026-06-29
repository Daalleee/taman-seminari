@extends('admin.layouts.admin')

@section('title', 'Kategori Kegiatan')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari kategori..." value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent w-64">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button onclick="openModal('modalKategori', null)"
                    class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Kategori
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="px-6 py-4 bg-gray-50 border-b">
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Nama</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Slug</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $category->slug }}</td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <button onclick="openModal('modalKategori', {{ json_encode($category) }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kategori-kegiatan.destroy', $category->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>

    {{-- Modal --}}
    <div id="modalKategori" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
            <form id="formKategori" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="_method" id="methodKategori" value="POST">

                <h3 id="modalKategoriTitle" class="text-lg font-semibold mb-4">Tambah Kategori</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="kategori_name" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" name="slug" id="kategori_slug"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan untuk mengisi otomatis.</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalKategori')"
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

            const form = document.getElementById('formKategori');
            const title = document.getElementById('modalKategoriTitle');
            const method = document.getElementById('methodKategori');

            if (data) {
                title.textContent = 'Edit Kategori';
                method.value = 'PUT';
                form.action = '{{ url("/admin/kategori-kegiatan") }}' + '/' + data.id;
                document.getElementById('kategori_name').value = data.name || '';
                document.getElementById('kategori_slug').value = data.slug || '';
            } else {
                title.textContent = 'Tambah Kategori';
                method.value = 'POST';
                form.action = '{{ route("admin.kategori-kegiatan.store") }}';
                form.reset();
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
