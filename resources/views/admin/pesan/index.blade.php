@extends('admin.layouts.admin')

@section('title', 'Pesan')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari nama/email/subjek..." value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent w-64">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="px-6 py-4 bg-gray-50 border-b">
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Nama</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Email</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Subjek</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr class="border-b hover:bg-gray-50 {{ !$message->is_read ? 'bg-green-50 font-semibold' : '' }}">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $message->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $message->email }}</td>
                            <td class="px-4 py-3 text-sm">{{ $message->subject ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $message->created_at ? \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') : '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($message->is_read)
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Dibaca</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Belum</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <button onclick="openModal('modalPesan', {{ json_encode($message) }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.pesan.destroy', $message->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
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
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada pesan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>

    {{-- Modal Detail --}}
    <div id="modalPesan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4 max-h-screen overflow-y-auto p-6">
            <h3 class="text-lg font-semibold mb-4">Detail Pesan</h3>

            <div class="space-y-3">
                <div>
                    <span class="text-sm font-medium text-gray-600">Nama:</span>
                    <p id="pesan_name" class="text-sm text-gray-900"></p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Email:</span>
                    <p id="pesan_email" class="text-sm text-gray-900"></p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Subjek:</span>
                    <p id="pesan_subject" class="text-sm text-gray-900"></p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Pesan:</span>
                    <p id="pesan_message" class="text-sm text-gray-900 bg-gray-50 p-3 rounded"></p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Tanggal:</span>
                    <p id="pesan_date" class="text-sm text-gray-900"></p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a id="pesan_balas" href="#" target="_blank"
                   class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm inline-flex items-center gap-1">
                    <i class="fas fa-reply"></i> Balas
                </a>
                <button type="button" onclick="closeModal('modalPesan')"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded text-sm">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, data) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('pesan_name').textContent = data.name || '-';
            document.getElementById('pesan_email').textContent = data.email || '-';
            document.getElementById('pesan_subject').textContent = data.subject || '-';
            document.getElementById('pesan_message').textContent = data.message || '-';
            document.getElementById('pesan_date').textContent = data.created_at || '-';

            const balas = document.getElementById('pesan_balas');
            balas.href = 'mailto:' + (data.email || '') + '?subject=Re: ' + encodeURIComponent(data.subject || '');
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
