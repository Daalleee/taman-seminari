@extends('admin.layouts.admin')

@section('title', 'Agenda')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari agenda..." value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent w-64">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button onclick="openModal('modalAgenda', null)"
                    class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Agenda
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="px-6 py-4 bg-gray-50 border-b">
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Judul</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Lokasi</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agendas as $agenda)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $agenda->title }}</td>
                            <td class="px-4 py-3 text-sm">{{ $agenda->event_date ? \Carbon\Carbon::parse($agenda->event_date)->format('d/m/Y H:i') : '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $agenda->location ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <button onclick="openModal('modalAgenda', {{ json_encode($agenda) }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
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
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada agenda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $agendas->links() }}
        </div>
    </div>

    {{-- Modal --}}
    <div id="modalAgenda" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4 max-h-screen overflow-y-auto">
            <form id="formAgenda" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="_method" id="methodAgenda" value="POST">

                <h3 id="modalAgendaTitle" class="text-lg font-semibold mb-4">Tambah Agenda</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" id="agenda_title" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="agenda_description" rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu</label>
                        <input type="datetime-local" name="event_date" id="agenda_event_date"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="location" id="agenda_location"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Poster</label>
                        <input type="file" name="poster" id="agenda_poster"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <div id="agenda_poster_preview" class="mt-2 hidden">
                            <img src="" class="h-20 w-20 object-cover rounded">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalAgenda')"
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

            const form = document.getElementById('formAgenda');
            const title = document.getElementById('modalAgendaTitle');
            const method = document.getElementById('methodAgenda');

            if (data) {
                title.textContent = 'Edit Agenda';
                method.value = 'PUT';
                form.action = '{{ url("/admin/agenda") }}' + '/' + data.id;
                document.getElementById('agenda_title').value = data.title || '';
                document.getElementById('agenda_description').value = data.description || '';
                document.getElementById('agenda_location').value = data.location || '';

                if (data.event_date) {
                    const dt = new Date(data.event_date.replace(' ', 'T'));
                    const pad = (n) => String(n).padStart(2, '0');
                    document.getElementById('agenda_event_date').value =
                        dt.getFullYear() + '-' + pad(dt.getMonth()+1) + '-' + pad(dt.getDate()) + 'T' +
                        pad(dt.getHours()) + ':' + pad(dt.getMinutes());
                }

                const preview = document.getElementById('agenda_poster_preview');
                if (data.poster) {
                    preview.classList.remove('hidden');
                    preview.querySelector('img').src = '{{ asset("storage/") }}/' + data.poster;
                } else {
                    preview.classList.add('hidden');
                }
            } else {
                title.textContent = 'Tambah Agenda';
                method.value = 'POST';
                form.action = '{{ route("admin.agenda.store") }}';
                form.reset();
                document.getElementById('agenda_poster_preview').classList.add('hidden');
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
